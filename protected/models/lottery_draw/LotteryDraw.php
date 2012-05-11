<?php
/**
 *
 */
class LotteryDraw
{
    /**
     * @var string
     */
    private $now;

    /**
     * @var string
     */
    private $numCard;

    /**
     * @var string
     */
    private $numProduct;

    /**
     * @var string
     */
    private $numFlow;

    /**
     * @var int 从号码池中抽出的号码的数量，默认5个
     */
    private $quantity;

    /**
     * @var int 每个人可以抽奖次数，默认1次
     */
    private $times;

    /**
     * @param string $numCard
     * @param string $numProduct
     * @param string $numFlow
     */
    public function __construct($numCard, $numProduct, $numFlow)
    {
        $this->now = time();
        $this->numCard = $numCard;
        $this->numProduct = $numProduct;
        $this->numFlow = $numFlow;
    }

    /**
     * @return int
     */
    private function luckyNumber()
    {
        // 生成号码池
        $container = $this->now . $this->numCard . md5($this->numProduct) . md5($this->numFlow);
        $container = preg_split('//', $container, -1, PREG_SPLIT_NO_EMPTY);
        shuffle($container);

        // 抽出号码
        $max = count($container) - 1;
        $number = '';
        for($i = 0; $i < $this->quantity; $i++)
        {
            $position = mt_rand(0, $max);
            $char = $container[$position];
            $number .= $char;
        }
        // 将号码转换成数字
        $pattern = array('/a/i', '/b/i', '/c/i', '/d/i', '/e/i', '/f/i');
        $replace = array('10', '11', '12', '13', '14', '15');
        $number = preg_replace($pattern, $replace, $number);
        return (int) $number;
    }

    /**
     * @return int
     */
    public function doIt()
    {
        while(true)
        {
            $number = $this->luckyNumber();
            if(1 <= $number && 500 >= $number)
            {
                $condition = 'id_product = :id_product';
                $params = array(':id_product' => $number);
                if(Customer::model()->exists($condition, $params))
                {
                    continue;
                }
                else
                {
                    return $number;
                }
            }
            /* 抽奖次数 */
            if(1 < $this->times)
            {
                $this->times -= 1;
                continue;
            }
            return $number;
        }
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getTimes()
    {
        return $this->times;
    }

    /**
     * @param int $times
     */
    public function setTimes($times)
    {
        $this->times = $times;
    }

    /**
     * @return string
     */
    public function getNumCard()
    {
        return $this->numCard;
    }

    /**
     * @param string $numCard
     */
    public function setNumCard($numCard)
    {
        $this->numCard = $numCard;
    }

    /**
     * @return string
     */
    public function getNumProduct()
    {
        return $this->numProduct;
    }

    /**
     * @param string $numProduct
     */
    public function setNumProduct($numProduct)
    {
        $this->numProduct = $numProduct;
    }

    /**
     * @return string
     */
    public function getNumFlow()
    {
        return $this->numFlow;
    }

    /**
     * @param string $numFlow
     */
    public function setNumFlow($numFlow)
    {
        $this->numFlow = $numFlow;
    }

    /**
     * @return string
     */
    public function getNow()
    {
        return $this->now;
    }

    /**
     * @param string $now
     */
    public function setNow($now)
    {
        $this->now = $now;
    }
}
