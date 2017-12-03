<?php
  include "notice_db_info.php";
  // no은 현재페이지
  $no = $_GET['no'];
  if (!$no || $no < 0) $no=1;
  // 한 페이지에 보여질 게시글 수
  $page_size=8;
  // 페이지 리스트에 표시될 페이지 수
  $page_list_size=5;
  $start_article=$page_size*($no-1);
  // DB에서 page_size만큼의 글을 가져온다
  $result = mysqli_query($mysqli,"SELECT * from notice order by pk desc limit $start_article,$page_size");
  // 총 게시글수
  $result_count = mysqli_query($mysqli,"SELECT count from notice_count");
  $result_row = mysqli_fetch_row($result_count);
  $count = $result_row[0];
  if($count <= 0) {
    $count=0;
  }
  // 총 페이지수(0부터 시작)
  $total_page = (int)ceil($count/$page_size);
  // 현재 페이지
  $current_page = $no;
  //현재 출력되있는 페이지 블락(page_list_size가 5면 1~5는 1 6~10은 2)
  $current_block = (int)ceil(($current_page/$page_list_size));
  //현재 페이지 블락에 출력될 첫번째 페이지번호
  $start_page = $current_block*$page_list_size-($page_list_size-1);
  //현재 페이지 블락에 출력될 마지막 페이지번호
  $end_page = $start_page + $page_list_size-1;
  //마지막 블락 끝처리
  if($total_page < $end_page){
     $end_page=$total_page;
  }
?>
