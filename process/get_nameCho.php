<meta charset="utf-8" />
<table>
<?php

    //초성인지 확인하는 함수
    function ischo($str) {

        $cho = array("ㄱ","ㄲ","ㄴ","ㄷ","ㄸ","ㄹ","ㅁ","ㅂ","ㅃ","ㅅ","ㅆ","ㅇ","ㅈ","ㅉ","ㅊ","ㅋ","ㅌ","ㅍ","ㅎ");

        foreach ($cho as $arr) {
            if($str == $arr){
                return true;
            }
        }
        return false;
    }
    
    include "dbconn.php";

    // 현재는 맨 마지막에 입력된 텍스트의 위치를 기준으로
    // DB값과 대조하여 초성 검색을 하는 단계임.
    // ex) '김진완'을 검색하려 할때 [ㄱ] , [ 김ㅈ ] , [김진ㅇ]

    $name = $_GET['name'];
    
    //초성인지 테스트하는데 쓰이고, 초성이라면 sql의 where 문을
    //선택하는 switch case문에 쓰임. 초성이 아닐때는 빈 문자열 값 ""
    $cho;

    // 테스트용
    // echo "<script>console.log('param_data : '+'$param_data')</script>";


    // $name의 길이. 한글텍스트를 strlen함수에 쓰면, 한글 한 자리당 길이가 3으로 나온다.
    // 그래서 mb_strlen함수로 encoding type을 지정해서 사용하면 길이가 제대로 나온다.
    $l = mb_strlen($name, 'utf-8');

    // 테스트용
    // echo "<script>console.log('$l')</script>";

   

    if($l == 1) {//입력된 문자가 한자리인 경우

        if(ischo($name)) {// 문자가 초성인 경우
            $cho = $name;
            // echo "<script>console.log('cho : '+'$cho')</script>";
            $name = "";     
            // echo "한자리 이고 초성";

        }else { // 초성이 아닌 경우
            $cho="";
            // echo "한자리 이고 초성아님";
            // echo "<script>console.log('name : '+'$name')</script>";
        }
        // 테스트용
        // echo "<script>console.log('cho : '+'$cho')</script>";
        // 테스트용
        // echo "<script>console.log('name : '+'$name')</script>";

    }else if($l>1) {// 입력된 문자가 한자리 이상인 경우

        // 초성이 맨 뒷자리에 있다고 가정하고, 맨 뒷자리를 잘라낸다.
        // strlen과 같은 이유로 mb_substr함수를 쓴다.
        $cho = mb_substr($name, $l-1,1,'utf-8');
        // 테스트용
        // echo "<script>console.log('cho : '+'$cho')</script>";
        // 테스트용
        // echo "<script>console.log('name : '+'$name')</script>";

        if(ischo($cho)) {// 맨 마지막 문자가 초성인경우
            $name = mb_substr($name, 0,$l-1,'utf-8');
            // echo "한자리 아니고 초성임";
        }else {// 초성이 아닌 경우
            // echo "한자리 아니고 초성아님";
            //초성(맨 뒷자리)를 뺀 나머지 완전한(완전하다고 가정하는)텍스트를 잘라낸다.
            $cho = "";
            $name = $name.$cho;
        }
        // 테스트용
        // echo "<script>console.log('cho : '+'$cho')</script>";
        // 테스트용
        // echo "<script>console.log('name : '+'$name')</script>";

    }


    $sql_where;
    switch($cho) {
        case 'ㄱ':
        $sql_where = "substr(str,$l,1) >= '가' AND substr(str,$l,1) < '나' and  ";
        break;
        case 'ㄴ':
        $sql_where = "substr(str,$l,1) >= '나' AND substr(str,$l,1) < '다' and  ";
        break;
        case 'ㄷ':
        $sql_where = "substr(str,$l,1) >= '다' AND substr(str,$l,1) < '라' and  ";
        break;
        case 'ㄹ':
        $sql_where = "substr(str,$l,1) >= '라' AND substr(str,$l,1) < '마' and  ";
        break;
        case 'ㅁ':
        $sql_where = "substr(str,$l,1) >= '마' AND substr(str,$l,1) < '바' and  ";
        break;
        case 'ㅂ':
        $sql_where = "substr(str,$l,1) >= '바' AND substr(str,$l,1) < '사' and  ";
        break;
        case 'ㅅ':
        $sql_where = "substr(str,$l,1) >= '사' AND substr(str,$l,1) < '아' and  ";
        break;
        case 'ㅇ':
        $sql_where = "substr(str,$l,1) >='아' and substr(str,$l,1)< '자' and ";
        break;
        case 'ㅈ':
        $sql_where = "substr(str,$l,1) >= '자' AND substr(str,$l,1) < '차' and  ";
        break;
        case 'ㅊ':
        $sql_where = "substr(str,$l,1) >= '차' AND substr(str,$l,1) < '카' and  ";
        break;
        case 'ㅋ':
        $sql_where = "substr(str,$l,1) >= '카' AND substr(str,$l,1) < '타' and  ";
        break;
        case 'ㅌ':
        $sql_where = "substr(str,$l,1) >= '타' AND substr(str,$l,1) < '파' and  ";
        break;
        case 'ㅍ':
        $sql_where = "substr(str,$l,1) >= '파' AND substr(str,$l,1) < '하' and  ";
        break;
        case 'ㅎ':
        $sql_where = "substr(str,$l,1) >= '하' AND substr(str,$l,1) <'힣' and  ";
        break;
    }
    
    $sql = " SELECT store_id ,sname, owner_email ";
    $sql .= "FROM webpos.store WHERE sname like '$name%'";
    $sql .= " ORDER BY sname ASC ";
    
    // 테스트용
    // echo $sql;
    

    $result = mysqli_query($dbconn,$sql);
        
    while($rows = $result->fetch_assoc()) {
        echo "<tr><td>";
        echo "<span onclick='setValue(this, \"".$rows['store_id']."\" );'>".$rows['sname']."</span>, ".$rows['owner_email'];
        echo "</td></tr>";
    }
?>
</table>