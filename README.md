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
    "name":"小红",
    "mobile":"1888888888",
    "email":[
        "2222222222@qq.com",
        "19110101010@qq.com",
        "jljdslkaj838@outlook.com"
    ],
    "age":"28",
    "sex":"男",
    "address":[
        "重庆市XXXXXXXX",
        [
            "大渡口区XXXXXXX",
            "渝北区CCCCCC",
            "北碚区VVVVVVV"
        ]
    ]
}
```
