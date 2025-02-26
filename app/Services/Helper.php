<?php

namespace App\Services; 
use DOMDocument;
use GuzzleHttp\Client;


class Helper // Tên class khớp với tên file
{
    /**
     * Kiểm tra xem dữ liệu có rỗng hoặc null không
     *
     * @param mixed $data Dữ liệu cần kiểm tra
     * @return bool
     */
    public static function isEmptyOrNull($data): bool
    {
        if (is_null($data)) {
            return true;
        }
        if (is_string($data) && trim($data) === '') {
            return true;
        }
        if (is_array($data) && empty($data)) {
            return true;
        }
        return false;
    }

    /**
     * lay thong tin by msst
     */
    public static function getByTaxcode2($taxcode)
    {
        $urlToken = 'https://masothue.com/Ajax/Token';
        $client = new Client();
        // $response = $client->request('POST', $urlToken, [
        //     'headers' => [
        //         'User-Agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Mobile Safari/537.36',
        //     ]
        // ]);
        // $body = $response->getBody()->getContents();
        // $tokenResponse = json_decode($body);
        // $token = $tokenResponse->token;
    
        $urlSearch = 'https://masothue.com/Search?q=' . $taxcode . '&type=auto&token=&force-search=1';
        $response = $client->request('GET', $urlSearch, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Mobile Safari/537.36',
            ],
            'allow_redirects' => true
        ]);
        $body = $response->getBody(); // Stream object
        $searchHtml = $body->getContents(); // Chuỗi

        if (self::isEmptyOrNull($searchHtml)) return null;

       // Khởi tạo DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($searchHtml); // @ để tránh warning về HTML không chuẩn

        // Mảng kết quả
        $result = [];

        // Lấy từng thông tin
        $thElements = $dom->getElementsByTagName('th');
        $nameDirect = $thElements->item(0)->nodeValue;
        $result["name"] = $nameDirect;
        $result['loai_hinh_dn'] = 1;
        $trs = $dom->getElementsByTagName('tr');
        foreach ($trs as $tr) {
            $tds = $tr->getElementsByTagName('td');
            if ($tds->length >= 2) {
                $label = trim($tds->item(0)->textContent); // Cột đầu tiên (label)
                $value = $tds->item(1); // Cột thứ hai (giá trị)

                // Lấy text từ span.copy hoặc a nếu có
                $span = $value->getElementsByTagName('span');
                $a = $value->getElementsByTagName('a');
                $text = $span->length > 0 ? trim($span->item(0)->textContent) : (
                    $a->length > 0 ? trim($a->item(0)->textContent) : trim($value->textContent)
                );

                // Gán vào mảng theo label
                switch ($label) {
                    case 'Mã số thuế':
                        $result['mst'] = $text;
                        break;
                    case 'Địa chỉ':
                        $result['dia_chi'] = $text;
                        break;
                    case 'Người đại diện':
                        $result['nguoi_dai_dien'] = $text;
                        break;
                    case 'Điện thoại':
                        $result['std'] = $text;
                        break;
                    case 'Ngày hoạt động':
                        $result['ngay_hoat_dong'] = $text;
                        break;
                    case 'Quản lý bởi':
                        $result['quan_ly_boi'] = $text;
                        break;
                    case 'Mã số thuế cá nhân':
                        $result['loai_hinh_dn'] = 2;
                        break;
                    case 'Tình trạng':
                        $result['tinh_trang'] = $text;
                        break;
                    case 'Ngành nghề chính':
                        $result['main_profession'] = $text;
                        break;
                }
            }
        }
        return $result;
    }
}