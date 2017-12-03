//하이퍼링크 클릭시 페이지 상단이동 방지
$(document).ready(function($){

  $('a[href^="#"]').click(function(e) {
    e.preventDefault();
});
})

// 자유게시판 쓰기/삭제 권한 활성화
function freeboard_able(param) {

    var url;
    var pass;
    var decide = document.getElementById(param).children;
    var elem = decide[1].children;
    //Off -> On 변경
    var route;
    var data;
    try {
        if (elem[0].innerHTML == "Off") {

            url = '../admin_settings/admin_info.php';
            pass = {
                'sign': "freeboard_on",
                'id': param
            };

        } else if (elem[0].innerHTML == "On") {
            url = '../admin_settings/admin_info.php';
            pass = {
                'sign': "freeboard_off",
                'id': param
            };



        }



        $.ajax({
            url: url, // form 넘길주소라고 보시면 돼요
            dataType: 'json',
            data: pass, //왼쪽부터 name값 , value값
            type: "POST",
            //php코드가 잘 실행되면 success, syntax error같이 exception이 발생하면 error가 뜹니다.
            success: function(data) {

                //data가 true일때
                if (data) {
                    if (data == "freeboard_on") {
                        elem[0].innerHTML = "On";
                        elem[0].className = "btn btn-success";

                    }
                    if (data == "freeboard_off") {
                        elem[0].innerHTML = "Off";
                        elem[0].className = "btn btn-default";


                    }




                } else { //false일때
                    alert("인증되지 않은 사용자입니다.");


                }

                //return true;
            },
            error: function(error) {

                alert("Error");
                return false;
            }
        });
    } catch (e) {
        if (window.bridgeGotTime) {
            throw e;
        } else {
            //page reload?
        }
    }


}

//공지사항 쓰기/삭제 권한 활성화
function notice_able(param) {
    var decide = document.getElementById(param).children;
    var elem = decide[2].children;
    var url;
    var pass;
    try {
        if (elem[0].innerHTML == "Off") {
            url = '../admin_settings/admin_info.php';
            pass = {
                'sign': "notice_on",
                'id': param
            };

        } else if (elem[0].innerHTML == "On") {
            url = '../admin_settings/admin_info.php';
            pass = {
                'sign': "notice_off",
                'id': param
            };



        }



        $.ajax({
            url: url, // form 넘길주소라고 보시면 돼요
            dataType: 'json',
            data: pass, //왼쪽부터 name값 , value값
            type: "POST",
            //php코드가 잘 실행되면 success, syntax error같이 exception이 발생하면 error가 뜹니다.
            success: function(data) {
                //data가 true일때
                if (data) {
                    if (data == "notice_on") {
                        elem[0].innerHTML = "On";
                        elem[0].className = "btn btn-success";

                    }
                    if (data == "notice_off") {
                        elem[0].innerHTML = "Off";
                        elem[0].className = "btn btn-default";


                    }



                    return false;
                } else { //false일때
                    alert("인증되지 않은 사용자입니다.");


                }

                //return true;
            },
            error: function(error) {

                alert("Error");
                return false;
            }
        });
    } catch (e) {
        if (window.bridgeGotTime) {
            throw e;
        } else {
            //page reload?
        }
    }


}
//등업
function privilege(param) {


    var elem = document.getElementById(param);
    var button = document.getElementById(param.split("-")[0] + "-button");
    var old = param.split("-")[0];
    var data = button.innerHTML;

    if (data == "운영자") {
        old += "-operator"
    } else if (data == "하이큐브회원") {
        old += "-hycube"
    } else if(data == "일반") {
        old += "-normal"
    }else{
      alert("error");
    }

    console.log(data);
    old_elem = document.getElementById(old);

    old_elem.className = "";
    button.innerHTML = elem.firstChild.innerHTML;

    elem.className = "active";
    url = '../admin_settings/admin_info.php';
    pass = {

        'target': param.split("-")[0],
        'sign': param.split("-")[1],

    };
    console.log(param.split("-")[0]);
    console.log(param.split("-")[1]);

    $.ajax({
        url: url, // form 넘길주소라고 보시면 돼요
        dataType: 'json',
        data: pass, //왼쪽부터 name값 , value값
        type: "POST",
        //php코드가 잘 실행되면 success, syntax error같이 exception이 발생하면 error가 뜹니다.
        success: function(data) {
            //data가 true일때
            if (data) {
                return true;
            } else { //false일때
                alert("인증되지 않은 사용자입니다.");


            }

            //return true;
        },
        error: function(error) {

            alert("Error");
            return false;
        }
    });


}
//자유게시판 댓글폼 체크함수//
function checkWriteCommentForm(form) {

    if (form.user_name.value == '') {
        alert("이름을 입력해 주세요");
        form.user_name.focus();
        return false;
    }
    if (form.comments.value == '') {
        alert("내용을 입력해 주세요");
        form.comments.focus();
        return false;
    }
    if (form.passwd.value == '') {
        alert("비밀번호를 입력해 주세요");
        form.passwd.focus();
        return false;
    }

    return true;

}
