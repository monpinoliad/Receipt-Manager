<?php

namespace CoreBundle\Manager;

use CoreBundle\Entity\Receipt;
use CoreBundle\Utils\DatabaseUtils;
use CoreBundle\Utils\SlugUtils;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ReceiptManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Receipt
     */
    private $receipt;

    /**
     * @var DatabaseUtils
     */
    private $databaseUtils;

    /**
     * @var SlugUtils
     */
    private $slugUtils;

    /**
     * TagManager constructor.
     *
     * @param EntityManagerInterface $em
     * @param SlugUtils $slugUtils
     * @param DatabaseUtils $databaseUtils
     * @param ContainerInterface $container
     */
    public function __construct(
        EntityManagerInterface $em,
        SlugUtils $slugUtils,
        DatabaseUtils $databaseUtils,
        ContainerInterface $container
    )
    {
        $this->em = $em;
        $this->slugUtils = $slugUtils;
        $this->container = $container;
        $this->databaseUtils = $databaseUtils;
    }

    /**
     * Get the receipt.
     *
     * @return Receipt
     */
    public function getReceipt(): Receipt
    {
        return $this->receipt;
    }

    /**
     * Set the receipt.
     *
     * @param Receipt $receipt
     *
     * @return ReceiptManager
     */
    public function setReceipt(Receipt $receipt): ReceiptManager
    {
        $this->receipt = $receipt;
        return $this;
    }

    /**
     * Get all receipt.
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function getAll()
    {
        try {
            return $this
                ->em
                ->getRepository(Receipt::class)
                ->getAll();

        } catch (\Exception $e) {
            throw new \Exception(
                'An error occurred at the fetching all data in the database.'
            );
        }
    }

    /**
     * This function is for creating the receipt.
     *
     * @throws \Exception
     *
     * @return ReceiptManager
     */
    public function create(): ReceiptManager
    {
        try {
            $this->generateSlugId();
        } catch (\Exception $e) {
            throw new \Exception(
                'There\s an error in creating the receipt.'
            );
        }

        return $this;
    }

    /**
     * Get the id of current receipt.
     *
     * @param string $id The id of the receipt.
     *
     * @throws \Exception
     *
     * @return Receipt
     */
    public function getById(int $id): Receipt
    {
        try {
            $product = $this
                ->em
                ->getRepository(Receipt::class)
                ->findOneBy(
                    array(
                        'id' => $id
                    )
                );
        } catch (\Exception $e) {
            throw new \Exception(
                'An error occurred at the getting the id of a receipt.'
            );
        }

        return $product;
    }

    /**
     * Delete a receipt.
     *
     * @throws \Exception
     *
     * @return ReceiptManager
     */
    public function remove(): ReceiptManager
    {
        $this
            ->databaseUtils
            ->remove($this->receipt);

        return $this;
    }

    /**
     * Save a receipt.
     *
     * @throws \Exception
     *
     * @return ReceiptManager
     */
    public function save(): ReceiptManager
    {
        $this
            ->databaseUtils
            ->save($this->receipt);

        return $this;
    }

    /**
     * To generate the receipt slugId.
     *
     * @throws \Exception
     *
     * @return ReceiptManager
     */
    public function generateSlugId(): ReceiptManager
    {
        $receiptId = $this->entityCount($this->receipt);
        try {
            if ($receiptId <= 0) {
                $receiptId++;

                $this
                    ->receipt
                    ->setSlugId(
                        $this
                            ->slugUtils
                            ->slugifyId($receiptId, 'R')
                    );
            } else {
                $result = ltrim(
                    $this
                        ->getLastCreated()
                        ->getSlugId(),
                    'R'
                );
                $deSlugId = intval(ltrim($result, '0'));
                $deSlugId++;

                $this
                    ->getReceipt()
                    ->setSlugId(
                        $this
                            ->slugUtils
                            ->slugifyId($deSlugId, 'R')
                    );
            }
        } catch (\Exception $e) {
            throw new \Exception(
                'There\s an error in creating the slug id'
            );
        }

        return $this;
    }

    /**
     * Get the receipt by the slug id.
     *
     * @param string $slugId The slugid of the product that will be returned.
     *
     * @throws \Exception
     *
     * @return Receipt
     */
    public function getBySlugId(string $slugId): Receipt
    {
        try {
            $products = $this
                ->em
                ->getRepository(Receipt::class)
                ->findOneBy(
                    array(
                        'slugId' => $slugId
                    )
                );
        } catch (\Exception $e) {
            $products = null;

            throw new \Exception(
                'An error occurred at the getting slug id of a receipt.'
            );
        }

        return $products;
    }

    /**
     * Get the row count.
     *
     * @throws \Exception
     *
     * @return int
     */
    public function entityCount(): int
    {
        try {
            return $this
                ->em
                ->getRepository(Receipt::class)
                ->getRowCount();
        } catch (\Exception $e) {
            throw new \Exception(
                'Error occurred while retrieving the row count.'
            );
        }
    }

    /**
     * Get the last created product.
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function getLastCreated()
    {
        try {
            return $this
                ->em
                ->getRepository(Receipt::class)
                ->getLastCreated();
        } catch (\Exception $e) {
            throw new \Exception(
                'Error occurred while getting the last created receipt.'
            );
        }
    }
}