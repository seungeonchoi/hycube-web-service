
var idFlag = false;
var pwFlag = false;
var pw_check_Flag = false;
var nameFlag = false;
var emailFlag = false;


$(document).ready(function($) {



            // 공백입력방지
            $("#pwd, #email, #pwd_check").bind("keypress", function(e) {
                Events.PreventSpace(e);
            });

            // 한글입력방지
            $("email").css("ime-mode", "disabled");

            // 숫자만입력
            /*	$("#hp_no2, #hp_no3").bind("keypress", function (e) {
            		Events.CheckDigit(e);
            	});
            */
            /* $("#cancel").click(function () {
            		location.href = 'https://sslmember2.gmarket.co.kr/Registration/MemberRegistrationBuyer';
            	});
            */
            /////////////////////////////// 휴대폰 체크 ///////////////////////////////
            /*$("#hp_no2").blur(function(){
            		var phone = document.getElementById("hp_no2").value;
            		var phone3 = document.getElementById("hp_no3").value;
            		var oMsg = document.getElementById("hpMsg");
            		var oMsgC = document.getElementById("hpMsgCheck");

            		if (phone == "" || (getStringByteLength(phone) < 3)) {
            			oMsg.style.display = "block";
            			oMsg.innerHTML = "전화번호를 정확히 입력해 주세요.";
            			oMsgC.className = "bg_area icon_bg chk";
            			return false;
            		}

            		if ( passonlynum($("#hp_no2").val()) ) {
            			oMsg.style.display = "block";
            			oMsg.innerHTML = "전화번호는 숫자로만 입력하세요.";
            			oMsgC.className = "bg_area icon_bg chk";
            			$("#hp_no2").val("");
            			return false;
            		}

            		if (phone3 != "") {
            			oMsgC.className = "bg_area icon_bg chk submit";
            		}

            		if (true) {
            			oMsg.style.display = "none";
            			return true;
            		}

            		return true;
            	});

            	$("#hp_no3").blur(function(){
            		var phone = document.getElementById("hp_no3").value;
            		var phone2 = document.getElementById("hp_no2").value;
            		var oMsg = document.getElementById("hpMsg");
            		var oMsgC = document.getElementById("hpMsgCheck");

            		if (phone == "" || (getStringByteLength(phone) != 4)) {
            			oMsg.style.display = "block";
            			oMsg.innerHTML = "전화번호를 정확히 입력해 주세요.";
            			oMsgC.className = "bg_area icon_bg chk";
            			return false;
            		}

            		if ( passonlynum($("#hp_no3").val()) ) {
            			oMsg.style.display = "block";
            			oMsg.innerHTML = "전화번호는 숫자로만 입력하세요.";
            			oMsgC.className = "bg_area icon_bg chk";
            			$("#hp_no3").val("");
            			return false;
            		}

            		if (phone2 != "") {
            			oMsgC.className = "bg_area icon_bg chk submit";
            		}

            		if (true) {
            			oMsg.style.display = "none";
            			return true;
            		}
            		return true;
            	});
            	*/
            /////////////////////////////// 휴대폰 체크 ///////////////////////////////

            /////////////////////////////// 아이디 체크 ///////////////////////////////

	$("#username").blur(function(){
		var id = document.getElementById("username").value;
		var oMsg = document.getElementById("iderr");
		var oMsg_2 = document.getElementById("iderr_info");
		//var oMsgC = document.getElementById("idMsgCheck");

		idFlag = false;

		if (id == "") {
			oMsg.style.display = "block";
			oMsg_2.innerHTML = "필수 정보입니다.";
			return false;
		}
    if(id == "Admin"){
      oMsg.style.display = "block";
			oMsg_2.innerHTML = "관리자 이름은 사용할 수 없습니다.";
      return false;

    }
		var isID = /^[a-zA-Z0-9]{2,10}$/;
		if (!isID.test(id)) {
			oMsg.style.display = "block";

			oMsg_2.innerHTML = "회원 아이디(ID)는 띄어쓰기 없이 2~10자리의 영문자와 숫자 조합만 가능합니다.";
			$("#username").focus();
//			$("#login_id").val("");
			return false;
		}

    oMsg.style.display = "none";
    idFlag=true;
		return true;
	});

            /////////////////////////////// 아이디 체크 ///////////////////////////////

            /////////////////////////////// 비밀번호 체크 ///////////////////////////////
            $("#pwd").blur(function() {

                var grade = "";
                var pwd;
                var oMsg;
                var oMsgC;
                var num = 2;
                pw_Flag = false;

                pwd = $("#pwd").val();
                oMsg = document.getElementById("pwderr");
                oMsg_2 = document.getElementById("pwderr_info");
                //oMsgC = document.getElementById("pwd1MsgCheck");


                var safe_level = chkPasswordNew2(pwd);


                if (pwd.length >= 0) {


                        if (safe_level == "level00") {
                            grade = 1;

                        } else if (safe_level == "level01") {
                            grade = 2;

                        } else if (safe_level == "level02") {
                            grade = 3;

                        } else if (safe_level == "level03") {
                            grade = 4;

                        } else if (safe_level == "level04") {
                            grade = 5;
                            pwFlag=true;


                        }
                    }



                pwChk(grade, num);

                /*
                ""		grade = 0;	띄어쓰기 없는 6~15자의 영문 대/소문자, 숫자 및 특수문자 조합으로 입력하셔야 합니다.
                level00 grade = 1;	비밀번호 조합기준에 적합하지 않습니다.
                level01 grade = 2;	보안에 매우 취약하여 사용할 수 없습니다.
                level02 grade = 3;	적정 수준의 안전한 비밀번호입니다.
                level03 grade = 4;	매우 안전한 비밀번호 입니다.
                */
            });
            $("#pwd_check").blur(function() {

                var grade = "";
                var pwd;
                var oMsg;
                var oMsgC;

                pw_check_Flag = false;

                pwd = $("#pwd_check").val();
                oMsg = document.getElementById("pwd_checkerr");
                oMsg_2 = document.getElementById("pwd_checkerr_info");
                //oMsgC = document.getElementById("pwd1MsgCheck");


                var safe_level = chkPasswordNew2(pwd);

                if(pwd == "")
                {
                  oMsg.style.display = "block";
                  oMsg_2.innerHTML = "비밀번호를 다시 입력해 주세요."
                }
                else if(pwd != $("#pwd").val()){
                  oMsg.style.display = "block";
                  oMsg_2.innerHTML = "비밀번호가 일치하지 않습니다."
                }
                else{
                  oMsg.style.display = "none";
                  pw_check_Flag = true;

                }


                /*
                ""		grade = 0;	띄어쓰기 없는 6~15자의 영문 대/소문자, 숫자 및 특수문자 조합으로 입력하셔야 합니다.
                level00 grade = 1;	비밀번호 조합기준에 적합하지 않습니다.
                level01 grade = 2;	보안에 매우 취약하여 사용할 수 없습니다.
                level02 grade = 3;	적정 수준의 안전한 비밀번호입니다.
                level03 grade = 4;	매우 안전한 비밀번호 입니다.
                */
            });



            /////////////////////////////// 비밀번호 체크 ///////////////////////////////

            /////////////////////////////// 이메일 체크 ///////////////////////////////
            $("#email").blur(function() {



                var email = document.getElementById("email").value
                var oMsg = document.getElementById("emailerr");
                var oMsg_2 = document.getElementById("emailerr_info");

                emailFlag = false;

                if (email == "") {
                    oMsg.style.display = "block";
                    oMsg_2.innerHTML = "이메일 주소를 다시 확인해주세요.";
                    return false;
                }

                /*
                var isEmail = /^([a-z0-9.+_-]+)/;
                var isHan = /[ㄱ-ㅎ가-힣]/g;
                if (!isEmail.test(email1) || isHan.test(email1)) {
                	oMsg.style.display = "block";
                	oMsg.innerHTML = "이메일 주소를 다시 확인해주세요.";
                	return false;
                }
                */



                if (email != "") {

                    var isEmail = /^[ㄱ-힣\w-\.\_]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]{2,3}$/;
                    var isHan = /[ㄱ-ㅎ가-힣]/g;
                    if (!isEmail.test(email) || isHan.test(email)) {
                        oMsg.style.display = "block";
                        oMsg_2.innerHTML = "이메일 주소를 다시 확인해주세요.";
                        return false;
                    }

                    // 이메일 길이 제한 : 50
                    if (email.length > 50) {
                        oMsg.style.display = "block";
                        oMsg_2.innerHTML = "이메일 글자수가 도메인 포함하여 전체 50자 이내로 입력해주세요.";
                        return false;
                    }

                    try {

                        var url = '../register/email_check.php';
                        var param = {'email': email};

                        $.ajax({
                            url: url, // form 넘길주소라고 보시면 돼요
                            dataType: 'json',
                            data: param, //왼쪽부터 name값 , value값
                            type: "POST",
                            //php코드가 잘 실행되면 success, syntax error같이 exception이 발생하면 error가 뜹니다.
                            success: function(data) {
                                //data가 true일때
                                if (data) {
                                    oMsg.style.display = "block";
                                    oMsg_2.innerHTML = "이미 사용중인 이메일입니다.";
                                    $("#email").val("");

                                    return false;
                                } else {//false일때
                                    oMsg.style.display = "none";


                                }
                                emailFlag = true;
                                //return true;
                            },
                            error: function(error) {
                                emailFlag = false;
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

                if (true) {
                    oMsg.style.display = "none";
                    return true;
                }

                return true;
            });


            /////////////////////////////// 이메일 체크 ///////////////////////////////

            /////////////////////////////// 이름 체크 ///////////////////////////////
            /*
	$("#userName").blur(function(){
		var id = document.getElementById("username").value;
		var oMsg = document.getElementById("iderr");
		var oMsg_2 = document.getElementById("iderr_info");

		var oMsgC = document.getElementById("userNameMsgCheck");
		var bytes = getByteLength(name);

		nameFlag = false;

		if (name == "") {
			oMsg.style.display = "block";

			oMsg_2.innerHTML = "필수 정보입니다.";
			return false;
		}

		if (bytes < 2 || bytes > 30) {
			oMsg.style.display = "block";
			oMsg.className = "ability_chk";
			oMsg.innerHTML = "이름은 최대 15자(30 Byte)이내로 한글/영문만 가능합니다.";
			// document.getElementById("userName").value = "";
			return false;
		}

		var pattern = /[^(ㄱ-힣0-9a-zA-Z\. )]/;
        if(pattern.test(name)) {
			oMsg.style.display = "block";
			oMsg.className = "ability_chk";
			oMsg.innerHTML = "이름은 최대 15자(30 Byte)이내로 한글/영문만 가능합니다.";
            // document.getElementById("userName").value = "";
            return false;
        }

		if (true) {
			oMsg.style.display = "none";
			nameFlag = true;
			oMsgC.className = "bg_area icon_bg chk submit";
			return true;
		}

		return true;
	});

	$("#userName").keyup(function(){
		var name = document.getElementById("userName").value;
		var oMsg = document.getElementById("userNameMsg");
		var oMsgC = document.getElementById("userNameMsgCheck");
		var bytes = getByteLength(name);

		nameFlag = false;

		if (bytes > 30) {
			oMsg.style.display = "block";
			oMsg.className = "ability_chk";
			oMsg.innerHTML = "이름은 최대 15자(30 Byte)이내로 한글/영문만 가능합니다.";
			document.getElementById("userName").value = StringCutByte(name, 30);
			return false;
		}

		return true;
	});

	function StringCutByte(str, len){
		var l = 0;
		for (var i = 0; i < str.length; i++) {
			l += (str.charCodeAt(i) > 128) ? 2 : 1;
			if (l > len) return str.substring(0, i);
		}
		return str;
	}
	*/
	/////////////////////////////// 이름 체크 ///////////////////////////////
});


// --------------------------------------------------
// Events
// --------------------------------------------------
function Events() { }

Events.StopPostback = function (e) {
	if (e.preventDefault) {
		e.preventDefault();
		return false;
	}
	else {
		e.returnValue = false;
		return false;
	}
}

Events.PreventSpace = function (e) {
	if (e.which && (e.which == 13 || e.which == 32)) {
		e.preventDefault();
	}
}

// 숫자만 입력받을 수 있도록 keypress 이벤트로 처리
Events.CheckDigit = function (e) {
	if (e.which && (e.which > 47 && e.which < 58 || e.which == 8)) {

	}
	else {
		e.preventDefault();
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function ChangeMailServer(value1, value2) {
	if (value1 == "" || value2 == "직접입력") {
		//$("#email2").prop('readonly', false);
		$("#email2").prop('readonly', '');
	}
	else {
		//$("#email2").prop('readonly', true);
		$("#email2").prop('readonly', 'readonly');
	}
}

function pwChk(grade, num){
	var pwd;
	var oMsg;
	var oMsgC;


	pwd =  $("#pwd").val();
	oMsg = document.getElementById("pwerr");
	oMsg_2 = document.getElementById("pwerr_info");


	if (grade == 1) {

		oMsg.style.display = "block";

		oMsg_2.innerHTML = "띄어쓰기 없는 8~15자의 영문 대/소문자, 특수문자, 숫자로 입력하셔야 합니다.";
	}
	else if (grade == 2) {

		oMsg.style.display = "block";

		oMsg_2.innerHTML = "비밀번호 조합기준에 적합하지 않습니다.";
	}
	else if (grade == 3) {

		oMsg.style.display = "block";

		oMsg_2.innerHTML = "보안에 매우 취약하여 사용할 수 없습니다.";
	}
	else if (grade == 4) {

		oMsg.style.display = "block";

		oMsg_2.innerHTML = "특수문자는 들어갈 수 없습니다.";
	}
	else if (grade == 5) {

    oMsg.style.display = "none";


	}
  else{
    oMsg.style.display = "block";
    oMsg_2.innerHTML = "문제가 발생했습니다.";
  }
}

function chkPasswordNew(pwd)
{
	var tmpStr	= null;
	var pw		= pwd;
	var EnNum_pattern = /[^a-zA-Z0-9!\"#$%&\'()*+,-./:;<>=?@[]\\^_`{|}~]/;

	//비밀번호는 영문자, 숫자, 특수문자로만 구성, 6 ~ 15 자리만 허용
	if (EnNum_pattern.test(pw) || pw.length < 6 || pw.length > 15)
	{
		alert("비밀번호는 띄어쓰기 없이 6~15자의 영문 대/소문자, 숫자\n및 특수문자 2가지 이상 조합으로 입력하셔야 합니다.");
		$("#pwd1").val("");
		$("#pwd1").focus();
		return false;
	}

	//반드시 영문자, 숫자, 특수문자 혼용 (영문자, 숫자, 특수문자로만 된 패스워드 생성 금지)
	if (!(passonlynum(pw) && passonlyEng(pw) && passonlyChar(pw)))
	{
		alert("비밀번호는 띄어쓰기 없이 6~15자의 영문 대/소문자, 숫자\n및 특수문자 2가지 이상 조합으로 입력하셔야 합니다.");
		$("#pwd1").val("");
		$("#pwd1").focus();
		return false;
	}

	//영문자, 숫자, 특수문자만 사용
	if (!onlyEngNew(pw))
	{
		alert("비밀번호는 띄어쓰기 없이 6~15자의 영문 대/소문자, 숫자\n및 특수문자 2가지 이상 조합으로 입력하셔야 합니다.");
		$("#pwd1").val("");
		$("#pwd1").focus();
		return false;
	}

	//ID와 동일한 패스워드 생성 금지
	tmpStr = $("#login_id").val();
	if (tmpStr==pw)
	{
		alert("회원 아이디를 비밀번호로 사용할 수 없습니다.");
		$("#pwd1").val("");
		$("#pwd1").focus();
		return false;
	}

	/*전화번호 뒷자리가 포함된 패스워드 생성 금지
	tmpStr = $("#hp_no3").val();
	if (pw.indexOf(tmpStr)>=0 && tmpStr!="")
	{
		alert("전화번호가 포함된 비밀번호는 사용할 수 없습니다.");
		$("#pwd1").val("");
		$("#pwd1").focus();
		return false;
	}
	*/

	//동일한 숫자(문자)로 이루어진 패스워드 생성 금지
	for (var i=0; i<=pw.length-4; i++)
	{
		if (pw.charAt(i)==pw.charAt(i+1) && pw.charAt(i)==pw.charAt(i+2) && pw.charAt(i)==pw.charAt(i+3))
		{
			alert("4개 이상의 동일한 문자(숫자)가 포함된 비밀번호는 사용할 수 없습니다.");
			$("#pwd1").val("");
			$("#pwd1").focus();
			return false;
		}
	}

	//연속된 숫자로 이루어진 패스워드 생성 금지
	strNum = "01234567890";
	for (var i=0; i<=strNum.length-4; i++)
	{
		tmpStr=strNum.substring(i,i+4);
		if (pw.indexOf(tmpStr)>=0)
		{
			alert("연속된 4자리의 숫자가 포함된 비밀번호는 사용할 수 없습니다.");
			$("#pwd1").val("");
			$("#pwd1").focus();
			return false;
		}
	}
	return true;
}

// 비밀번호 유효성 체크
function chkPasswordNew2(pwd)
{
	var tmpStr	= null;
	var EnNum_pattern = /[^a-zA-Z0-9!\"#$%&\'()*+,-./:;<>=?@[]\\^_`{|}~]/;
	//비밀번호는 영문자, 숫자, 특수문자로만 구성, 6 ~ 15 자리만 허용
  /*
	if (EnNum_pattern.test(pwd) || pwd.length < 6 || pwd.length > 15)
	{
		return "level00";
	}
  */
	//동일한 숫자(문자)로 이루어진 패스워드 생성 금지
  if (pwd.length < 8 || pwd.length > 15)
	{
		return "level00";
	}
  /*
	for (var i=0; i<=pwd.length-4; i++)
	{
		if (pwd.charAt(i)==pwd.charAt(i+1) && pwd.charAt(i)==pwd.charAt(i+2) && pwd.charAt(i)==pwd.charAt(i+3))
		{
			return "level00";
		}
	}
  */


	//연속된 숫자로 이루어진 패스워드 생성 금지
  /*
	strNum = "01234567890";
	for (var i=0; i<=strNum.length-4; i++)
	{
		tmpStr=strNum.substring(i,i+4);
		if (pwd.indexOf(tmpStr)>=0)
		{
			return "level00";
		}
	}
  */

	//반드시 영문자, 숫자, 특수문자 혼용 (영문자, 숫자, 특수문자로만 된 패스워드 생성 금지)
	if (pwd.length >= 8 && (passonlynum(pwd) && passonlyEng(pwd) && passonlyChar(pwd)))
	{
    console.log(pwd);
    console.log("sibal");
		return "level04";
	}
    console.log("noma");
		return "level01";
}

//숫자로만 되어있는지 확인
function passonlynum(inText){
	var ret;
  var j = 0;
	for (var i = 0; i < inText.length; i++) {

		ret = inText.charCodeAt(i);
		if ((ret > 47) && (ret < 58)) {
			j = j+1;
		}

	}

  if (j == inText.length) {
		return false;	//영문자만 있는경우
	}
  else if(j == 0){
    return false; // 영문자가 없는경우
  }
  else{
		return true;	//영문자와 다른 문자가 있는경우
	}
}

//문자로만 되어 있는지 확인
function passonlyEng(inText)
{
	var ret;
	var j = 0;
	var alpha_num_Str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	for (var i = 0; i < inText.length; i++) {
		var substr = inText.substring(i,i+1);
		if (alpha_num_Str.indexOf(substr) < 0) {
			//영문자가 아닌값
		}else{
			j = j + 1;	//영문자
		}
	}
	if (j == inText.length) {
		return false;	//영문자만 있는경우
	}
  else if(j == 0){
    return false; // 영문자가 없는경우
  }
  else{
		return true;	//영문자와 다른 문자가 있는경우
	}
}

//특수문자로만 되어 있는지 확인
function passonlyChar(inText)
{
	var ret;
	var j = 0;
	var char_num_Str = "!\"#$%&\'()*+,-./:;<>=?@[]\\^_`{|}~";
	for (var i = 0; i < inText.length; i++) {
		var substr = inText.substring(i,i+1);
		if (char_num_Str.indexOf(substr) < 0) {
			//특수문자가 아닌값
		}

    else{
			j = j + 1;	//특수문자
		}
	}
	if (j == inText.length) {
		return false;	//특수문자만 있는경우
	}
  else if(j == 0){
    return false; // 특수문자가 없는경우
  }
  else{
		return true;	//특수문자와 다른 문자가 있는경우
	}
}

//영문, 숫자만 사용
function onlyEng(inText) {
var ret;
	for (var i = 0; i < inText.length;  i++) {
	ret = inText.charCodeAt(i);
		if ( i != 0 ) {
			if ((ret > 122) || (ret < 48) || (ret > 57 && ret < 65) || (ret > 90 && ret < 97)) {
				return false;
			}
		}
	}
	return true;
}

// 영문, 숫자, 특수문자만 사용
function onlyEngNew(inText)
{
	var ret;
	for (var i = 0; i < inText.length; i++) {
		ret = inText.charCodeAt(i);
		if ( i != 0 ) {
			if ((ret < 33) || (ret > 126)) {
				return false;
			}
		}
	}
	return true;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/// 회원 가입 ///
function Signup() {

	if (!idFlag) {
    document.getElementById("signerrormessage").innerHTML = "아이디 입력이 잘못되었습니다.";
    $('#signuperror').modal();
		return;
	}

	if (!pwFlag) {
    document.getElementById("signerrormessage").innerHTML = "비밀번호 입력이 잘못 되었습니다.";
    $('#signuperror').modal();
		return;
	}
  if (!pw_check_Flag) {
    document.getElementById("signerrormessage").innerHTML = "비밀번호가 일치하지 않습니다.";
    $('#signuperror').modal();
		return;
	}
  /*
	if (!nameFlag) {
		alert("이름 입력이 잘못 되었습니다.");
		return;
	}
 */
	if (!emailFlag) {
    document.getElementById("signerrormessage").innerHTML = "이메일 입력이 잘못 되었습니다.";
    $('#signuperror').modal();
		return;
	}

	// 인증 유무
  /*
	if (!AuthCheck()) return;
  */
	// 아이디 체크
  /*
	if (!IDCheck()) return;

	// 비밀번호 체크
	if (!PasswordCheck()) return;
	// 이름 체크

	if (!NameCheck()) return;

	// 휴대폰 체크

	if (!HpNoCheck()) return;
*/
	// 이메일
  /*
  console.log("success?");
	if (!EmailCheck()) return;
  */
	$('#form_main').attr('action', 'signup.php').submit();

	return;
}

function AuthCheck()
{
	if($("#CertType").val() == "" || $("#CertName").val() == "" ||	$("#BirthDate").val() == "")
	{
    document.getElementById("signerrormessage").innerHTML = "실명확인 후에 가입이 가능합니다.";
    $('#signuperror').modal();
		return false;
	}

	return true;
}

function IDCheck() {

	if ($("#login_id").val() == "" ||  $.trim($("#login_id").val()) == 0) {
    document.getElementById("signerrormessage").innerHTML = "회원아이디(ID)를 입력해 주세요.";
    $('#signuperror').modal();
//		$("#login_id").val("");
		$("#login_id").focus();
		return false;
	}

	if(!IsValidID($("#login_id").val()))
	{
    document.getElementById("signerrormessage").innerHTML = "회원 아이디(ID)는 띄어쓰기 없이 6~10자리의 영문자와 숫자 조합만 가능합니다.";
    $('#signuperror').modal();
//		$("#login_id").val("");
		$("#login_id").focus();
		return false;
	}
	return true;
}

function PasswordCheck() {

	if ($("#pwd1").val() == "" || $.trim($("#pwd1").val()) == 0) {
    document.getElementById("signerrormessage").innerHTML = "비밀번호를 입력해 주세요.";
    $('#signuperror').modal();
		$("#pwd1").val("");
		$("#pwd1").focus();
		return false;
	}

	if ($("#pwd2").val() == "" || $.trim($("#pwd2").val()) == 0) {
    document.getElementById("signerrormessage").innerHTML = "비밀번호 확인을 위해서 한번 더 입력해 주세요.";
    $('#signuperror').modal();
		$("#pwd2").val("");
		$("#pwd2").focus();
		return false;
	}

	if ($("#pwd1").val() != $("#pwd2").val()) {
    document.getElementById("signerrormessage").innerHTML = "비밀번호가 틀립니다.";
    $('#signuperror').modal();
		$("#pwd1").val("");
		$("#pwd2").val("");
		$("#pwd1").focus();
		return false;
	}

	if (!chkPasswordNew($("#pwd1").val())) {
		return false;
	}
	return true;
}

function NameCheck() {

	if ($("#userName").val() == "" ||  $.trim($("#userName").val()) == 0) {
    document.getElementById("signerrormessage").innerHTML = "이름을 입력해 주세요.";
    $('#signuperror').modal();
//		$("#login_id").val("");
		$("#userName").focus();
		return false;
	}

	if(IsValidName($("#userName").val()))
	{
    document.getElementById("signerrormessage").innerHTML = "이름은 최대 15자(30 Byte)이내로 한글/영문만 가능합니다.";
    $('#signuperror').modal();
//		$("#login_id").val("");
		$("#userName").focus();
		return false;
	}
	return true;
}

function HpNoCheck()
{
	if ($("#hp_no2").val() == "") {
    document.getElementById("signerrormessage").innerHTML = "휴대폰 번호를 입력해 주세요.";
    $('#signuperror').modal();
		$("#hp_no2").focus();
		return false;
	}

	if ($("#hp_no3").val() == "") {
    document.getElementById("signerrormessage").innerHTML = "휴대폰 번호를 입력해 주세요.";
    $('#signuperror').modal();
		$("#hp_no3").focus();
		return false;
	}

	if ($("#hp_no1").val() == "") {
    document.getElementById("signerrormessage").innerHTML = "휴대폰 번호를 입력해 주세요.";
    $('#signuperror').modal();
		return false;
	}

	if(	passonlynum($("#hp_no2").val()) || passonlynum($("#hp_no3").val()) ) {
    document.getElementById("signerrormessage").innerHTML = "휴대폰번호는 숫자로만 입력하세요.";
    $('#signuperror').modal();
		$("#hp_no2").focus();
		return false;
	}

	//아이핀 인증 후 휴대폰 수동 입력 시
	$("#MobilePhoneNum").val($("#hp_no1").val()+"-"+$("#hp_no2").val()+"-"+$("#hp_no3").val());

	return true;
}

function EmailCheck() {

	if ($("#email1").val().length < 2) {
    document.getElementById("signerrormessage").innerHTML = "E-Mail 주소를 입력해 주세요.";
    $('#signuperror').modal();
		$("#email1").val("");
		$("#email1").focus();
		return false;
	}

	if ($("#email2").val().length < 2) {
    document.getElementById("signerrormessage").innerHTML = "E-Mail 주소를 입력해 주세요.";
    $('#signuperror').modal();
		$("#email2").val("");
		$("#email2").focus();
		return false;
	}

	if ($("#email2").val().indexOf(".") < 0) {
    document.getElementById("signerrormessage").innerHTML = "올바르지 않은 E-Mail 주소입니다. 다시 입력해 주세요.";
    $('#signuperror').modal();
		$("#email2").val("");
		$("#email2").focus();
		return false;
	}

	if ($("#email2").val() == "gmarket.co.kr") {
    document.getElementById("signerrormessage").innerHTML = "등록이 불가능한 이메일 주소입니다. \ngmarket.co.kr 외에 다른 이메일 주소를 입력해주세요";
    $('#signuperror').modal();
		$("#email1").val("");
		$("#email2").val("");
		$("#email1").focus();
		return false;
	}

	// 전체 이메일 주소!
	var email = $("#email1").val() + "@" + $("#email2").val();

	if (email == "help@gmarket.co.kr" || email == "gmarket@gmarket.co.kr" || email == "webmaster@gmarket.co.kr") {
    document.getElementById("signerrormessage").innerHTML = "올바르지 않은 E-Mail 주소입니다. 다시 입력해 주세요.";
    $('#signuperror').modal();
		$("#email1").val("");
		$("#email1").focus();
		return false;
	}

	if (sTextByteLen(email) > 50) {
    document.getElementById("signerrormessage").innerHTML = "이메일 주소가 너무 길어 입력이 되지 않습니다. 다른 이메일 주소를 선택하여 주십시오.";
    $('#signuperror').modal();
		return false;
	}
	return true;
}

function RcvYNCheck() {

	// 이메일 수신 여부
	if ($("#isRcvMail").prop('checked') == true) {
		$("#ERcvYn").val("Y");
	}
	else {
		$("#ERcvYn").val("N");
	}

	if ($("#isRcvSMS").prop('checked') == true) {
		$("#SmsRcvYn").val("Y");
	}
	else {
		$("#SmsRcvYn").val("N");
	}
	return true;
}

function IsValidID(value)
{
	if (sTextByteLen(value) < 6 || sTextByteLen(value) > 10)
	{
		return false;
	}
	else{
		var regExp = /[^0-9A-Za-z]/;
		return (!regExp.test( value ));
	}
}

function IsValidName(value)
{
	if (getByteLength(value) < 2 || getByteLength(value) > 30)
	{
		return false;
	}
	else{
		var regExp = /[^(ㄱ-힣0-9a-zA-Z\. )]/;
		return (regExp.test( value ));
	}
}


function sTextByteLen(sText) {
	var sTextLen = 0;

	for (var i = 0; i < sText.length; i++) {
		if (sText.charCodeAt(i) > 128) {
			sTextLen += 2;
		}
		else {
			sTextLen += 1;
		}
	}
	return sTextLen;
}

function getByteLength(strValue) {
		var iLength = 0;
		var chValue;

		if (strValue == null)
			return (0);

		for (var i = 0; i < strValue.length; i++) {
			chValue = escape(strValue.charAt(i));

			if (chValue.length == 1)				// 영문(1), 숫자(1)
				iLength++;
			else if (chValue.indexOf("%u") != -1)	// 한글(2)
				iLength += 2;
			else if (chValue.indexOf("%") != -1)	// ASCII(1)
				iLength += chValue.length / 3;
		}
		return (iLength);
	}

function getStringByteLength(pStr) {
	var c;
	var nLength = 0;
	var sStr = new String(pStr);

	for (i = 0; i < sStr.length; i++) {
		c = sStr.charAt(i);
		if (escape(c).length > 4)   // 한글
			nLength += 2;
		else
			nLength++;
	}
	return nLength;
}

/* 모바일 체크(모바일 경우 실행 될 함수);
function mobChk(fnc) {
	var mobileKeyWords = new Array('iPhone', 'iPad', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson');
	for (var word in mobileKeyWords) {
		if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
			//alert("모바일");
		}
	}
}*/
