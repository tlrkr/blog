 <?
  include "Snoopy.class.php";
  if($_GET["k"]) {
    $k=$_GET["k"];
  }
  else {
    $k="720p-with";
  }
  if($_GET["b"]) {
    $b=$_GET["b"];
  }
  else {
    $b="";
  }
  $snoopy= new snoopy;
$snoopy->fetch("http://torrentdn.net/bbs/rss.php?k=".$k."&b=".$b."");
$txt = str_replace("&","&amp;",$snoopy->results);

preg_match('/(.*?)<item>/i', $txt, $txtMatch );	// item 시작전의 정보를 취득

// item외에 영역은 모두 삭제 처리 
$txt = str_replace($txtMatch[1], "", $txt);	// item 태그 열기 전 태그 및 문자 삭제
$txt = str_replace("</channel></rss>", "", $txt); // item 태그 닫고 channel, rss 태그 삭제

// item을 배열로 처리 하기 위해서 배열 문자 삽입
$txt = str_replace("</item>", "</item>\r\n", $txt);
$txt = rtrim($txt, "\r\n");	// 마지막 개행문자 제거하기

// item을 배열로 분리
$txtArr = explode("\r\n", $txt);

$displayNum = 1;	// item 숫자를 위해서 세팅
$dispalyCount = 3;	// 보여질 숫자

// rss 태그 및 정보 
echo $txtMatch[1].chr(10); 

// item 태그 출력
foreach($txtArr as $value) {

echo $value;	// item 태스 사이 내용 출력

if($displayNum >= $dispalyCount ) {
// 원하는 갯수와 동일하거나 넘어 설 경우에 멈춤
break;
}

$displayNum++;
}
// rss 태그 닫아주기
echo chr(10)."</channel></rss>";