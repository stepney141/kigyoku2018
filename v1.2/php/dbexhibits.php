<?php

include_once 'dbmap.php';

class ExhibitsMapper extends DataMapper
{
    const ORDER_ASC = 0;
    const ORDER_DESC = 1;

    const COLUMN_ID = 10;
    const COLUMN_NAME = 11;
    const COLUMN_GROUPNAME = 12;
    const COLUMN_BUILDING = 13;
    const COLUMN_LOCATION = 14;
    const COLUMN_SUMMARY = 15;
    const COLUMN_CATEGORY = 16;
    const COLUMN_THUMBIMG = 17;

    const BUILDING_BD1 = 20;
    const BUILDING_BD2 = 21;
    const BUILDING_BD3 = 22;
    const BUILDING_BD4 = 23;
    const BUILDING_YD = 24;

    const CATEGORY_ACADEMIC = 30;
    const CATEGORY_ACTIVITY = 31;
    const CATEGORY_DISPLAY_LITERATURE = 32;
    const CATEGORY_DISPLAY_SCIENCE = 33;
    const CATEGORY_VIDEO = 34;
    const CATEGORY_MUSIC = 35;
    const CATEGORY_PERFORMANCE = 36;
    const CATEGORY_FOODS = 37;
    const CATEGORY_PURCHASE = 38;

    public function __construct($dbconn)
    {
        parent::__construct($dbconn);
    }

    public function acquireExhibitsAll($limit = null, $count = null)
    {
        if ($limit === null)
        {
            $sth = $this->dbconn->query("SELECT * FROM exhibits ORDER BY name DESC");
        }
        else
        {
            if ($count !== null) {
                $lim = "$limit, $count";
            } else {
                $lim = $limit;
            }

            $sth = $this->dbconn->query("SELECT * FROM exhibits ORDER BY name DESC LIMIT $lim;");
        }
        
        while (($row = $sth->fetch()) !== false)
        {
            yield $row;
        }
    }

    public function acquireExhibits($options)
    {
        /* -------------------- */
        /* Search by a keyword? */
        if (isset($options['keyword'])) {
            $keyword = $options['keyword'];
        } else {
            $keyword = null;
        }
        /* -------------------- */


        /* -------------------- */
        $lim = "";

        if (isset($options['limit'])) {
            $limit = $options['limit'];
            if (is_array($limit)) {
                if (count($limit) > 1) {
                    list($a, $b) = $limit;
                    $lim = "LIMIT $a, $b";
                } else {
                    $lim = "LIMIT $limit[0]";
                }
            } else {
                $lim = "LIMIT $limit";
            }
        }
        /* -------------------- */


        /* -------------------- */
        $orders = "";

        if (isset($options['orders'])) {
            foreach ($options['orders'] as $order) {
                if (!is_array($order)) throw new RuntimeException();
                $orders .= ', ' . self::columnString($order[0]) . ' ' . self::orderString($order[1]);
            }
        }
        /* -------------------- */


    /* =========================== */
        $constraints = "(TRUE";
        
        /* -------------------- */
        $buildings = "";
        if (isset($options['buildings'])) {
            $buildings .= " AND (FALSE";
            foreach ($options['buildings'] as $building) {
                $buildings .= " OR FIND_IN_SET('" . self::buildingString($building) . "', " . self::columnString(self::COLUMN_BUILDING) . ") > 0";
            }
            $buildings .= " )";
        }

        $constraints .= $buildings;
        /* -------------------- */

        /* -------------------- */
        $categories = "";
        if (isset($options['categories'])) {
            $categories .= " AND (FALSE";
            foreach ($options['categories'] as $category) {
                $categories .= " OR FIND_IN_SET('" . self::categoryString($category) . "', " . self::columnString(self::COLUMN_CATEGORY) . ") > 0";
            }
            $categories .= " )";
        }

        $constraints .= $categories;
        /* -------------------- */

        $constraints .= ")";
    /* =========================== */


        //echo $constraints . PHP_EOL;

        if ($keyword !== null) {
            /*
            Ewww....
            $sth = $this->dbconn->prepare("
                SELECT DISTINCT id, name, groupname, building, location, summary, category, thumbimg FROM (
                    SELECT 1 AS rnk, id, name, groupname, building, location, summary, category, thumbimg FROM exhibits WHERE name LIKE :key
                    UNION
                    SELECT 2 AS rnk, id, name, groupname, building, location, summary, category, thumbimg FROM exhibits WHERE groupname LIKE :key
                    UNION
                    SELECT 3 AS rnk, id, name, groupname, building, location, summary, category, thumbimg FROM exhibits WHERE summary LIKE :key
                ) tab
                ORDER BY rnk;
                ");
            */
            /*
            At least a better way
            */
            $sth = $this->dbconn->prepare("
                SELECT * FROM exhibits
                    WHERE (name LIKE :key OR groupname LIKE :key OR summary LIKE :key) AND $constraints
                        ORDER BY
                            CASE
                            WHEN (name LIKE :key) THEN 1
                            WHEN (groupname LIKE :key) THEN 2
                            ELSE 3
                            END
                            $orders
                    $lim;
                ");
        } else {
            if ($orders !== "") {
                $orders = preg_replace('/^, /', '', $orders);
                $orderBy = "ORDER BY $orders";
            } else {
                $orderBy = "";
            }

            $sth = $this->dbconn->prepare("
                SELECT * FROM exhibits WHERE $constraints $orderBy $lim;
                ");
        }

        $sth->execute([
            ':key' => "%" . addcslashes($keyword, '\_%') . "%"
        ]);
        
        while (($row = $sth->fetch()) !== false)
        {
            yield $row;
        }
    }

    protected static function columnString($column)
    {
        return [
            self::COLUMN_ID => 'id',
            self::COLUMN_NAME => 'name',
            self::COLUMN_GROUPNAME => 'groupname',
            self::COLUMN_BUILDING => 'building',
            self::COLUMN_LOCATION => 'location',
            self::COLUMN_SUMMARY => 'summary',
            self::COLUMN_CATEGORY => 'category',
            self::COLUMN_THUMBIMG => 'thumbimg'
        ][$column];
    }

    protected static function orderString($order)
    {
        return [
            self::ORDER_ASC => 'ASC',
            self::ORDER_DESC => 'DESC'
        ][$order];
    }

    protected static function buildingString($building)
    {
        return [
            self::BUILDING_BD1 => 'bd1',
            self::BUILDING_BD2 => 'bd2',
            self::BUILDING_BD3 => 'bd3',
            self::BUILDING_BD4 => 'bd4',
            self::BUILDING_YD => 'yd'
        ][$building];
    }

    protected static function categoryString($category)
    {
        return [
            self::CATEGORY_ACADEMIC => 'academic',
            self::CATEGORY_ACTIVITY => 'activity',
            self::CATEGORY_DISPLAY_LITERATURE => 'display_literature',
            self::CATEGORY_DISPLAY_SCIENCE => 'display_science',
            self::CATEGORY_VIDEO => 'video',
            self::CATEGORY_MUSIC => 'music',
            self::CATEGORY_PERFORMANCE => 'performance',
            self::CATEGORY_FOODS => 'foods',
            self::CATEGORY_PURCHASE => 'purchase'
        ][$category];
    }

}


$exhibits = new ExhibitsMapper(GyokuwebDB::Instance());
/*
$result = $exhibits->acquireExhibits([
    'keyword' => '中',
    'limit' => 5,
    'orders' => [
        [ExhibitsMapper::COLUMN_ID, ExhibitsMapper::ORDER_ASC]
    ],
    'buildings' => [ExhibitsMapper::BUILDING_BD1],
    'categories' => [ExhibitsMapper::CATEGORY_ACADEMIC]
]);
 */

$result = $exhibits->acquireExhibits([
    'keyword' => $_GET['q'],
    'limit' => 5,
    'orders' => [
        [ExhibitsMapper::COLUMN_NAME, ExhibitsMapper::ORDER_ASC]
    ],
]);

//var_dump(iterator_to_array($result));
//
echo json_encode(iterator_to_array($result), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);