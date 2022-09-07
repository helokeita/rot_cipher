<?php

$value = "";

$title = "";

$result = "";

$html = file_get_contents("index.html");


if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if($_POST['str'] === ''){
        $result  = '入力してくださいな';
        unset($_POST['str']);
    }
    else{
        $value = htmlspecialchars($_POST['str']);
        

        for($i=1; $i <=26; $i++){
            $result .= "【" ;
            $result .= "ROT$i";
            $result .= "】";
            $result .= str_rot(htmlspecialchars($_POST['str']),$i);
            $result .= "  ";
        }

        $title .= "検索した文字：";
        $title .= htmlspecialchars($value);
        unset($_POST['str']);
    }

    $html = str_replace("{value}",htmlspecialchars($value),$html);
    
    $html = str_replace("{title}",htmlspecialchars($title),$html);
    
    $html = str_replace("{result}",htmlspecialchars($result),$html);
}
else{

    $html = str_replace("{value}",htmlspecialchars($value),$html);

    $html = str_replace("{title}",htmlspecialchars($title),$html);

    $html = str_replace("{result}",htmlspecialchars($result),$html);

}

    
printf($html);


function str_rot($s, $n = 13) {
    // 文字列を識別
    static $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // 26以上の数にならないようにする
    $n = (int)$n % 26;
    // 0だとそのまま返す
    if (!$n) return $s;
    // 13だと用意されている変数を使用
    if ($n == 13) return str_rot13($s);

    //文字数分for文を回す
    for ($i = 0, $l = strlen($s); $i < $l; $i++) {
        $c = $s[$i];
        // 小文字文字であるなら
        if ($c >= 'a' && $c <= 'z') {
            // 文字コードに変換して、ずらす
            // 配列に配置する
            $s[$i] = $letters[(ord($c) - 71 + $n) % 26];
        } 
        // 大文字文字文字であるなら
        else if ($c >= 'A' && $c <= 'Z') {
            // 文字コードに変換して、ずらす
            // 配列に配置する
            $s[$i] = $letters[(ord($c) - 39 + $n) % 26 + 26];
        }
    }
    // 配列を返す
    return $s;
}
