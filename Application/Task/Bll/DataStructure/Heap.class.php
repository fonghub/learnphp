<?php


namespace Task\Bll\DataStructure;

class Base
{
    public $fn = null;
    public $size = 0;
    public $element = [];

    public function __construct()
    {
        $this->element[0] = null;
        $this->fn = function ($data) {
            return $data;
        };
    }
}

class MaxHeap extends Base
{
    public function __construct()
    {
        parent::__construct();
    }
    // arr 要调整的数组资源
    // from 根节点的偏移量
    // to 子树的偏移量
    // fn 函数
    public static function adjust(&$arr, $from, $to, $fn)
    {
        //$tempValue = $fn( $arr[ $from ] );
        $rootValue = $arr[$from];
        // parent 是根节点，parent * 2是左子树, ( parent * 2 ) + 1是右子树
        // 对于此处来说，收到的只有父节点而已，根据父节点来判断子节点而并不是直接将子节点当参数传输进来
        //echo 'from : '.$from.PHP_EOL;
        for ($parent = $from; $parent * 2 <= $to; $parent = $child) {
            $child = $parent * 2;
            if ($child < $to && $arr[$child] < $arr[$child + 1]) {
                $child++;
            }
            //echo $parent.' : '.$child.PHP_EOL.PHP_EOL;
            // 如果根节点比子节点小，那么交换二者数据
            if ($rootValue < $arr[$child]) {
                $temp = $arr[$parent];
                $arr[$parent] = $arr[$child];
                $arr[$child] = $temp;
            } else {
                //echo "避免重复比较".PHP_EOL;
                break;
            }
        }
    }

    public static function array2max(array $arr)
    {
        $max = new MaxHeap();
        $max->size = count($arr);
        array_unshift($arr, null);
        //print_r( $arr );exit;
        // 开始循环数组
        for ($i = $max->size; $i > 0; $i--) {
            // 这个循环就是用来 确定每个节点以及其父节点的
            $parentIndex = floor($i / 2);
            if ($parentIndex > 0) {
                //echo $parentIndex.PHP_EOL;
                self::adjust($arr, $parentIndex, $max->size, $max->fn);
            }
        }
        $max->element = $arr;
        //print_r( $max->element );
        return $max;
    }

    public function delete()
    {
        $data = $this->element[1];
        $this->element[1] = $this->element[$this->size];
        self::adjust($this->element, 1, $this->size - 1, $this->fn);
        unset($this->element[$this->size]);
        $this->size--;
        return $data;
    }

    public function insert($data)
    {
        $this->size++;
        $this->element[$this->size] = $data;
        for ($i = $this->size; $i > 0; $i--) {
            $parentIndex = floor($i / 2);
            if ($parentIndex > 0) {
                self::adjust($this->element, $parentIndex, $this->size, $this->fn);
            }
        }
    }
}

$max = MaxHeap::array2max(array(50, 10, 90, 30, 70, 40, 80, 60, 20));
print_r($max->element);
$max->insert(5);
print_r($max->element);
$max->delete();
print_r($max->element);