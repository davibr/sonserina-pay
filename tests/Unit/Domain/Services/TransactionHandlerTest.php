<?php

declare(strict_types=1);

namespace Unit\Domain\Services;

use App\Domain\Clients\NotifierClientInterface;
use App\Domain\Clients\TaxManagerClientInterface;
use App\Domain\Entities\Buyer;
use App\Domain\Entities\Seller;
use App\Domain\Entities\Transaction;
use App\Domain\Exceptions\FraudCheckerException;
use App\Domain\Factories\CheckServiceFactory;
use App\Domain\Repositories\TransactionRepositoryInterface;
use App\Domain\Services\FraudChecker;
use App\Domain\Services\Notifier;
use App\Domain\Services\TaxCalculator;
use App\Domain\Services\TransactionHandler;
use App\Domain\Services\TransactionValidator;
use PHPUnit\Framework\TestCase;

class TransactionHandlerTest extends TestCase
{
    /**
     * @var TransactionRepositoryInterface
     */
    private TransactionRepositoryInterface $repository;

    /**
     * @var TaxManagerClientInterface
     */
    private TaxManagerClientInterface $taxManagerClientInterface;

    /**
     * @var TaxCalculator
     */
    private TaxCalculator $taxCalculator;

    /**
     * @var NotifierClientInterface
     */
    private NotifierClientInterface $notifierClienteInterface;

    /**
     * @var TransactionValidator
     */
    private TransactionValidator $transactionValidator;

    /**
     * @var Transaction
     */
    private Transaction $transaction;

    /**
     * @var CheckServiceFactory
     */
    private CheckServiceFactory $checkServiceFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->createMock(TransactionRepositoryInterface::class);

        $this->taxManagerClientInterface = $this->createMock(TaxManagerClientInterface::class);
        $this->taxManagerClientInterface->method('getIncrementValue')->willReturn(16.0);
        $this->taxCalculator = new TaxCalculator($this->taxManagerClientInterface);

        $this->notifierClienteInterface = $this->createMock(NotifierClientInterface::class);

        $this->transaction = new Transaction();
        $this->transaction->setInitialAmount(100);
        $this->transaction->setSellerTax(7);
        $this->transaction->setSeller(new Seller(uniqid(""), "teste", "teste@teste.com"));
        $this->transaction->setBuyer(new Buyer(uniqid(""), "teste 2", "teste2@teste.com"));

        $this->transactionValidator = new TransactionValidator();

        $this->checkServiceFactory = new CheckServiceFactory();
    }

    public function testCreate(): void
    {
        $this->repository->expects($this->exactly(1))->method('save')->will($this->returnArgument(0));

        $fraudChecker = new FraudChecker($this->checkServiceFactory);

        $this->notifierClienteInterface->expects($this->exactly(2))
            ->method('notify');
        $notifier = new Notifier($this->notifierClienteInterface);

        $handler = new TransactionHandler($this->repository, $this->taxCalculator, $fraudChecker, $notifier, $this->transactionValidator);

        $output = $handler->create($this->transaction);
        $this->assertNotNull($output);
        $this->assertNotNull($output->getCreatedDate());
        $this->assertEquals(16.0, $output->getSlytherinPayTax());
        $this->assertEquals(123.0, $output->getTotalAmount());
        $this->assertEquals(23.0, $output->getTotalTax());
    }

    public function testCreateFraud(): void
    {
        $this->repository->expects($this->exactly(0))->method('save')->will($this->returnArgument(0));

        $fraudChecker = $this->createMock(FraudChecker::class);
        $fraudChecker->method('check')->willReturn(false);

        $this->notifierClienteInterface->expects($this->exactly(0))
            ->method('notify');
        $notifier = new Notifier($this->notifierClienteInterface);

        $handler = new TransactionHandler($this->repository, $this->taxCalculator, $fraudChecker, $notifier, $this->transactionValidator);

        $this->expectException(FraudCheckerException::class);

        $handler->create($this->transaction);
    }

    public function testCreateInvalid(): void
    {
        $this->repository->expects($this->exactly(0))->method('save')->will($this->returnArgument(0));

        $fraudChecker = new FraudChecker($this->checkServiceFactory);

        $this->notifierClienteInterface->expects($this->exactly(0))
            ->method('notify');
        $notifier = new Notifier($this->notifierClienteInterface);

        $handler = new TransactionHandler($this->repository, $this->taxCalculator, $fraudChecker, $notifier, $this->transactionValidator);

        $this->expectExceptionMessage('Transação inválida.');

        $this->transaction->setInitialAmount(-10);

        $handler->create($this->transaction);
    }
}
