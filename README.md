# json-printer

`composer require ninenight/json-printer`

> 格式化json数据的显示

- demo

```php
    $array = [
            'name' => '小红',
            'mobile' => '1888888888',
            'email' => [
                '2222222222@qq.com',
                '19110101010@qq.com',
                'jljdslkaj838@outlook.com'
            ],
            'age' => '28',
            'sex' => '男',
            'address' => [
                '重庆市XXXXXXXX',
                [
                    '大渡口区XXXXXXX',
                    '渝北区CCCCCC',
                    '北碚区VVVVVVV'
                ],
            ],
        ];

        $newJson = (new Json($array))->jsonFormat();

        halt($newJson);
```

- 输出

```php
{
    "name":"dhailing",
    "mobile":"18290257791",
    "email":[
        "206989662@qq.com",
        "1066179972@qq.com",
        "dh1066179972@outlook.com"
    ],
    "age":"28",
    "sex":"1",
    "address":[
        "重庆市石柱县龙沙镇大沙村",
        [
            "大渡口区九宫庙",
            "渝北区康庄",
            "北碚区采集光彩路"
        ]
    ]
}
```
