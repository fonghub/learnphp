<?php


namespace Task\Bll\DataStructure;


/*
 * https://github.com/elarity/data-structure-php-clanguage/blob/master/15.%E5%9F%BA%E7%A1%80%E6%9F%A5%E6%89%BE%E4%B9%8B%E7%B4%A2%E5%BC%95%E5%85%A5%E9%97%A8.md
 */
class Index
{

    public static function make($num, $filepath)
    {
        $user_suf_arr = [];
        for ($i = 1; $i <= $num; $i++) {

            // 随机一个数值 user后缀
            $user_suf = mt_rand(1, $num * 20);
            // 如果在数组中
            if (in_array($user_suf, $user_suf_arr)) {
                // 回滚
                $i--;
                continue;
            }
            $user_suf_arr[] = $user_suf;

            $user[$i] = ['name' => 'user' . $user_suf, 'age' => mt_rand(1, 100), 'gender' => mt_rand(1, 2),];
            $uid_index_arr[$user_suf] = $i;
        }

        file_put_contents($filepath . 'user.json', json_encode($user));
        file_put_contents($filepath . 'user.index.json', json_encode($uid_index_arr));
    }


    /*
     * 查找个人信息
     */
    public static function read_1($filepath)
    {
        $begin_time = microtime( true );
        // 读取数据
        $user = file_get_contents( $filepath.'user.json' );
        $user = json_decode( $user, true );
        // 假如很短时间内500个人并发查询
        // 查找同一个用户名不会有缓存，所以不用考虑缓存影响速度的问题
        for( $i = 1; $i <= 500; $i++ ){
            foreach( $user as $user_item ){
                if( 'user1497036' == $user_item['name'] ){
                    //echo '找到了'.PHP_EOL;
                    echo "第{$i}次，".$user_item['age'] . PHP_EOL;
                }
            }
        }
        $end_time = microtime( true );
        echo '耗费时间'.( $end_time - $begin_time ).PHP_EOL;
    }

    /*
     * 使用索引查找
     */
    public static function read_2($filepath)
    {
        $begin_time = microtime(true);
        // 读取数据
        $user = file_get_contents($filepath.'user.json');
        $user = json_decode($user, true);
        // 读取索引
        $index = file_get_contents($filepath.'user.index.json');
        $index = json_decode($index, true);
        // 假如很短时间内500个人并发查询
        // 查找同一个用户名不会有缓存，所以不用考虑缓存影响速度的问题
        for ($i = 1; $i <= 500; $i++) {
            $suf = substr('user1497036', 4);
            // 在索引文件中查找对应关系
            $_index = $index[$suf];
            $_user = $user[$_index];
            echo "第{$i}次，".$_user['age'] . PHP_EOL;
        }
        $end_time = microtime(true);
        echo '耗费时间' . ($end_time - $begin_time) . PHP_EOL;
    }
}