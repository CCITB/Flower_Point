<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>..</title>
<style>
	body {
		font-size: small;
		font-family: Arial, '맑은 고딕';
	}
</style>
</head>
<body>


<h1>네이버 회원가입</h1>

<form action="" method="get" id="form1">
	<h2>참고문서</h2>
	<ul>
		<li><a href="#">네이버 이용약관 동의</a> 문서</li>
		<li><a href="#">개인정보 수집 및 이용에 대한 안내</a> 문서</li>
		<li><a href="#">위치정보 이용약관 동의</a> 문서</li>
	</ul>

	<h2>약관선택</h2>
	<p>
		<label>
			<input type="checkbox" name="all" id="all">
			전체선택
		</label>
	</p>
	<p>
		<label>
			<input type="checkbox" name="c1" id="c1">
			네이버 이용약관 동의(필수)
		</label>
	</p>
	<p>
		<label>
			<input type="checkbox" name="c2" id="c2">
			개인정보 수집 및 이용에 대한 안내(필수)
		</label>
	</p>
	<p>
		<label>
			<input type="checkbox" name="c3" id="c3">
			위치정보 이용약관 동의(선택)
		</label>
	</p>

	<p>
		<input type="submit" value="동의">
		<input type="reset" value="미동의">
	</p>
</form>

<p>사업체, 법인 또는 공식 단체라면? <a href="#">단체회원가입</a></p>


<script>
	var doc = document;
	var form1 = doc.getElementById('form1');
	var inputs = form1.getElementsByTagName('INPUT');
	var form1_data = {
		"c1": false,
		"c2": false,
		"c3": false
	};

	var c1 = doc.getElementById('c1');
	var c2 = doc.getElementById('c2');
	var c3 = doc.getElementById('c3');

	function checkboxListener() {
		form1_data[this.name] = this.checked;

		if(this.checked) {
			// submit 할때 체크하지 않아 색이 변한 font 를 다시 원래 색으로 바꾸는 부분.
			this.parentNode.style.color = "#000";
		}
	}


		c1.onclick = c2.onclick = c3.onclick = checkboxListener;

		var all = doc.getElementById('all');

		all.onclick = function() {
			if (this.checked) {
				setCheckbox(form1_data, true);
			} else {
				setCheckbox(form1_data, false);
			}
		};


		function setCheckbox(obj, state) {
			for (var x in obj) {
				obj[x] = state;

				for(var i = 0; i < inputs.length; i++) {
					if(inputs[i].type == "checkbox") {
						inputs[i].checked = state;
					}
				}

			}
		}


	/*all.onclick = function() {
		if (this.checked) {
			for (var x in form1_data) {
				form1_data[x] = true;

				for(var i = 0; i < inputs.length; i++) {
					if(inputs[i].type == "checkbox") {
						inputs[i].checked = true;
					}
				}

			}
		} else {
			for (var x in form1_data) {
				form1_data[x] = false;

				for(var i = 0; i < inputs.length; i++) {
					if(inputs[i].type == "checkbox") {
						inputs[i].checked = false;
					}
				}

			}
		}
	}; */


	form1.onsubmit = function(e) {
		e.preventDefault(); // 서브밋 될때 화면이 깜빡이지 않게 방지

		if ( !form1_data['c1'] ) {
			alert('네이버 이용약관 동의를 하지 않았습니다');
			c1.parentNode.style.color = 'red';
			return false;
		}

		if ( !form1_data['c2'] ) {
			alert('개인정보 수집 및 이용에 대한 안내를 선택하지 않았습니다.');
			return false;
		}

		this.submit();
	};
</script>
</body>
</html>
