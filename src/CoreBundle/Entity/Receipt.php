<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Receipt
 *
 * @ORM\Table(name="receipt")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ReceiptRepository")
 */
class Receipt
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_id", type="string", length=255, unique=true)
     */
    private $slugId;

    /**
     * @var string
     *
     * @ORM\Column(name="receipt_number", type="string", length=255)
     */
    private $receiptNumber;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="shop", type="string", length=255)
     */
    private $shop;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_issued", type="datetime")
     */
    private $dateIssued;

    /**
     * @var string
     *
     * @ORM\Column(name="input_by", type="string", length=255)
     */
    private $inputBy;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Receipt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Receipt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set slugId
     *
     * @param string $slugId
     *
     * @return Receipt
     */
    public function setSlugId($slugId)
    {
        $this->slugId = $slugId;

        return $this;
    }

    /**
     * Get slugId
     *
     * @return string
     */
    public function getSlugId()
    {
        return $this->slugId;
    }

    /**
     * Set receiptNumber
     *
     * @param string $receiptNumber
     *
     * @return Receipt
     */
    public function setReceiptNumber($receiptNumber)
    {
        $this->receiptNumber = $receiptNumber;

        return $this;
    }

    /**
     * Get receiptNumber
     *
     * @return string
     */
    public function getReceiptNumber()
    {
        return $this->receiptNumber;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Receipt
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set shop
     *
     * @param string $shop
     *
     * @return Receipt
     */
    public function setShop($shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return string
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Set dateIssued
     *
     * @param \DateTime $dateIssued
     *
     * @return Receipt
     */
    public function setDateIssued($dateIssued)
    {
        $this->dateIssued = $dateIssued;

        return $this;
    }

    /**
     * Get dateIssued
     *
     * @return \DateTime
     */
    public function getDateIssued()
    {
        return $this->dateIssued;
    }

    /**
     * Set inputBy
     *
     * @param string $inputBy
     *
     * @return Receipt
     */
    public function setInputBy($inputBy)
    {
        $this->inputBy = $inputBy;

        return $this;
    }

    /**
     * Get inputBy
     *
     * @return string
     */
    public function getInputBy()
    {
        return $this->inputBy;
    }
}

