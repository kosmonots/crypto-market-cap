<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * CryptoCurrency
 *
 * @ORM\Table(name="crypto_currency")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CryptoCurrencyRepository")
 */
class CryptoCurrency
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
     * @var string
     *
     * @ORM\Column(name="crypto_id", type="string", length=255, nullable=true)
     */
    private $cryptoId;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="symbol", type="string", length=255, nullable=true)
     */
    private $symbol;

    /**
     * @var string
     *
     * @ORM\Column(name="rank", type="string", length=255, nullable=true)
     */
    private $rank;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=24, scale=6, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="price_btc", type="string", length=255, nullable=true)
     */
    private $priceBtc;

    /**
     * @var string
     *
     * @ORM\Column(name="volume24h", type="decimal", precision=24, scale=6, nullable=true)
     */
    private $volume24h;

    /**
     * @var string
     *
     * @ORM\Column(name="market_cap", type="decimal", precision=24, scale=6, nullable=true)
     */
    private $marketCap;

    /**
     * @var string
     *
     * @ORM\Column(name="available_supply", type="decimal", precision=24, scale=6, nullable=true)
     */
    private $availableSupply;

    /**
     * @var string
     *
     * @ORM\Column(name="total_supply", type="decimal", precision=24, scale=6, nullable=true)
     */
    private $totalSupply;

    /**
     * @var string
     *
     * @ORM\Column(name="percent_change_1h", type="string", length=255, nullable=true)
     */
    private $percentChange1h;

    /**
     * @var string
     *
     * @ORM\Column(name="percent_change_24h", type="string", length=255, nullable=true)
     */
    private $percentChange24h;

    /**
     * @var string
     *
     * @ORM\Column(name="percent_change_7d", type="string", length=255, nullable=true)
     */
    private $percentChange7d;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="last_updated", type="string", length=255, nullable=true)
	 */
	private $lastUpdated;

	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="crypto_currency")
	 */
	private $user;

	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Currency", inversedBy="crypto_currency")
	 *
	 */
	private $currency;


	/**
	 * @ORM\Column(type="string", unique=true)
	 * @Gedmo\Slug(fields={"name"})
	 */
	private $slug;


	/**
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
	private $publishedAt;

	/**
	 * @Gedmo\Timestampable(on="update")
	 * @ORM\Column(type="datetime")
	 */
	private $updatedAt;


	public function __construct()
	{
		$this->user = new ArrayCollection();
		$this->currency = new ArrayCollection();
	}

	/**
	 * @return mixed
	 */
	public function getPublishedAt()
	{
		return $this->publishedAt;
	}

	/**
	 * @return mixed
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

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
     * Set cryptoId
     *
     * @param string $cryptoId
     *
     * @return CryptoCurrency
     */
    public function setCryptoId($cryptoId)
    {
        $this->cryptoId = $cryptoId;

        return $this;
    }

    /**
     * Get cryptoId
     *
     * @return string
     */
    public function getCryptoId()
    {
        return $this->cryptoId;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return CryptoCurrency
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CryptoCurrency
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set symbol
     *
     * @param string $symbol
     *
     * @return CryptoCurrency
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set rank
     *
     * @param string $rank
     *
     * @return CryptoCurrency
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return string
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return CryptoCurrency
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceBtc
     *
     * @param string $priceBtc
     *
     * @return CryptoCurrency
     */
    public function setPriceBtc($priceBtc)
    {
        $this->priceBtc = $priceBtc;

        return $this;
    }

    /**
     * Get priceBtc
     *
     * @return string
     */
    public function getPriceBtc()
    {
        return $this->priceBtc;
    }

    /**
     * Set volume24h
     *
     * @param string $volume24h
     *
     * @return CryptoCurrency
     */
    public function setVolume24h($volume24h)
    {
        $this->volume24h = $volume24h;

        return $this;
    }

    /**
     * Get volume24h
     *
     * @return string
     */
    public function getVolume24h()
    {
        return $this->volume24h;
    }

    /**
     * Set marketCap
     *
     * @param string $marketCap
     *
     * @return CryptoCurrency
     */
    public function setMarketCap($marketCap)
    {
        $this->marketCap = $marketCap;

        return $this;
    }

    /**
     * Get marketCap
     *
     * @return string
     */
    public function getMarketCap()
    {
        return $this->marketCap;
    }

    /**
     * Set availableSupply
     *
     * @param string $availableSupply
     *
     * @return CryptoCurrency
     */
    public function setAvailableSupply($availableSupply)
    {
        $this->availableSupply = $availableSupply;

        return $this;
    }

    /**
     * Get availableSupply
     *
     * @return string
     */
    public function getAvailableSupply()
    {
        return $this->availableSupply;
    }

    /**
     * Set totalSupply
     *
     * @param string $totalSupply
     *
     * @return CryptoCurrency
     */
    public function setTotalSupply($totalSupply)
    {
        $this->totalSupply = $totalSupply;

        return $this;
    }

    /**
     * Get totalSupply
     *
     * @return string
     */
    public function getTotalSupply()
    {
        return $this->totalSupply;
    }

    /**
     * Set percentChange1h
     *
     * @param string $percentChange1h
     *
     * @return CryptoCurrency
     */
    public function setPercentChange1h($percentChange1h)
    {
        $this->percentChange1h = $percentChange1h;

        return $this;
    }

    /**
     * Get percentChange1h
     *
     * @return string
     */
    public function getPercentChange1h()
    {
        return $this->percentChange1h;
    }

    /**
     * Set percentChange24h
     *
     * @param string $percentChange24h
     *
     * @return CryptoCurrency
     */
    public function setPercentChange24h($percentChange24h)
    {
        $this->percentChange24h = $percentChange24h;

        return $this;
    }

    /**
     * Get percentChange24h
     *
     * @return string
     */
    public function getPercentChange24h()
    {
        return $this->percentChange24h;
    }

    /**
     * Set percentChange7d
     *
     * @param string $percentChange7d
     *
     * @return CryptoCurrency
     */
    public function setPercentChange7d($percentChange7d)
    {
        $this->percentChange7d = $percentChange7d;

        return $this;
    }

    /**
     * Get percentChange7d
     *
     * @return string
     */
    public function getPercentChange7d()
    {
        return $this->percentChange7d;
    }

	/**
	 * @return string
	 */
	public function getLastUpdated()
	{
		return $this->lastUpdated;
	}

	/**
	 * @param string $lastUpdated
	 */
	public function setLastUpdated($lastUpdated)
	{
		$this->lastUpdated = $lastUpdated;
	}

	/**
	 * @return mixed
	 */
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * @param mixed $slug
	 */
	public function setSlug($slug)
	{
		$this->slug = $slug;
	}



	public function addUser(User $user)
	{
		if($this->user->contains($user)){
			return;
		}

		$this->user[] = $user;
	}

	public function addCurrency(Currency $currency)
	{
		if($this->currency->contains($currency)){
			return;
		}

		$this->currency[] = $currency;
	}

	/**
	 * @return mixed
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @return mixed
	 */
	public function getCurrency()
	{
		return $this->currency;
	}


}

