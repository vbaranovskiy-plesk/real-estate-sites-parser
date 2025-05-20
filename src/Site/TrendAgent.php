<?php
namespace App\Site;

class TrendAgent implements SiteInterface
{
    public function getReportFileName(): string
    {
        return 'trend.agent' . '-' . date("Y-m-d") . '.xlsx';
    }

    public function getData(): array
    {
        //$content = file_get_contents('https://api.trendagent.ru/v4_29/checkerboards/64ef0c1717c1996ab3aa5fdc/apartments/?building_id=64ef0d4717c199c973aa6007&auth_token=eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7ImlkIjoiNjZhODkwYzFlOWVlYWFlZDM5MjlkMGVjIiwibmFtZSI6ItCh0L7Qu9C-0LLRhtC-0LLQsCDQlNCw0YDRjNGPINCf0LXRgtGA0L7QstC90LAifSwidG9rZW5faWQiOiIxMnZhaXNwYjZsZmc5eGw3Znl5dTlwYzU5eWE1NnAiLCJjbGllbnQiOiJ3ZWIiLCJpYXQiOjE3NDEwMTM1MDAsImV4cCI6MTc2OTgxMzUwMH0.Qiz4jefBDkmZ6eHNvSmQxT7P5xJ4qho9KhILFMD_pu6NUi-NaUwMmDw7F4T_Nlv04dUQHoN7uvB_2d5X1iqHpBK1BxHhBTTbn1l9PbUyM1vYgzgRox8KaFnQVJTldnFcZsO6mSMYlusVu7QK8rwHtujYQgq9Gp7QvoBUEI6h1uY&city=618120c1a56997000866c4d8&lang=ru');
        $content = file_get_contents('https://api.trendagent.ru/v4_29/checkerboards/64ef0c1717c1996ab3aa5fdc/apartments/?building_id=64ef0d4717c199c973aa6007&auth_token=eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7ImlkIjoiNjZhODkwYzFlOWVlYWFlZDM5MjlkMGVjIiwibmFtZSI6ItCh0L7Qu9C-0LLRhtC-0LLQsCDQlNCw0YDRjNGPINCf0LXRgtGA0L7QstC90LAifSwidG9rZW5faWQiOiJtYTNzdjBzbm9pdDFuZTlzbGx1c3ZyaHloeXA1MWsiLCJjbGllbnQiOiJ3ZWIiLCJpYXQiOjE3NDEwMTQxODMsImV4cCI6MTc2OTgxNDE4M30.MFhlAS0ArggiFtu_VptuokFgSozabm36149D4ya830TRqQ3BQuFosu9VTYksDiGqZa0tC2KxiX0A0kgL2etSVSq4vr0OS2xAgxgbv4Pa2QZ8deo8mGc8OYGQm9lu2C_FZQWXJt7wqwus880y8iHRG-27XU3FjVVEfzvQlNaYw1c&city=618120c1a56997000866c4d8&lang=ru');

        $data = json_decode($content, true);
        var_dump($data);
        return [];
    }

}