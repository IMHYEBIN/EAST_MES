<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php
$item_code = $_POST["item_code"];
$item_name = $_POST["item_name"];

$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);

/////////////////////////////////////////////////////////////////////검색
//조건 중 하나라도 입력이 되었으면 WHERE 추가
if ($item_code != null || $item_name != null) {
	$temp0 = "where";
} else {
	$temp0 = "";
}

//검색조건 1
if ($item_code != null) {
	$temp1 = " parent like '" . $item_code . "'";
	//검색O = 플래그1
	$flag1 = 1;
} else {
	$temp1 = "";
	//검색X = 플래그0
	$flag1 = 0;
}

// //검색조건 2
// if ($item_name != null) {
//     //앞에서 검색을 해서 플래그1이 넘어왔으면 AND를 붙임
//     if ($flag1 == 1) {
//         $temp2 = " and item_name like '" . $item_name . "'";
//     }
//     //앞에서 검색을 하지않아서 플래그0이 넘어왔으면 AND를 붙이지 않음
//     else
//         $temp2 = " item_name like '" . $item_name . "'";
//     //플래그 0이 넘어왔으나 여기서 검사를 했으니 플래그 1
//     $flag1 = 1;
// } else {
//     $temp2 = "";
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
	<title>Document</title>
</head>

<body>
	<div id="tree">
		<ul>
			<?php
			$sql = "select * from bom where parent like '" . $item_code . "'";
			$res = mysqli_query($conn, $sql);

			/////////////////////////////////////////////////////////Root 표시
			if ($item_code != null) {
				//클래스명은 검색시 펼쳐보이기 위한 옵션임
				echo "<li class='jstree-open' id = 'root'>" . $item_code;

				/////////////////////////////////////////////////////////1단계 표시

				//Root 자식이 여러개일경우 행 개수만큼 반복
				for (; $row = mysqli_fetch_array($res);) {

					echo "<ul><li class='jstree-open'>" . $row['child'];

					//child결과가 있을 경우 자식을 부모로 다시 검색
					if ($row['child'] != null) {
						$sql1 = "select * from bom where parent like '" . $row['child'] . "'";
						$res1 = mysqli_query($conn, $sql1);
						/////////////////////////////////////////////////////////2단계 표시
						for (; $row1 = mysqli_fetch_array($res1);) {
							echo "<ul><li class='jstree-open'>" . $row1['child'];

							//child결과가 있을 경우 자식을 부모로 다시 검색
							if ($row1['child'] != null) {
								$sql2 = "select * from bom where parent like '" . $row1['child'] . "'";
								$res2 = mysqli_query($conn, $sql2);

								for (; $row2 = mysqli_fetch_array($res2);) {
									echo "<ul><li class='jstree-open'>" . $row2['child'];

									//child결과가 있을 경우 자식을 부모로 다시 검색
									if ($row2['child'] != null) {
										$sql3 = "select * from bom where parent like '" . $row2['child'] . "'";
										$res3 = mysqli_query($conn, $sql3);

										for (; $row3 = mysqli_fetch_array($res3);) {
											echo "<ul><li class='jstree-open'>" . $row3['child'];

											//child결과가 있을 경우 자식을 부모로 다시 검색
											if ($row3['child'] != null) {
												$sql4 = "select * from bom where parent like '" . $row3['child'] . "'";
												$res4 = mysqli_query($conn, $sql4);

												for (; $row4 = mysqli_fetch_array($res4);) {
													echo "<ul><li class='jstree-open'>" . $row4['child'];

													//child결과가 있을 경우 자식을 부모로 다시 검색
													if ($row4['child'] != null) {
														$sql5 = "select * from bom where parent like '" . $row4['child'] . "'";
														$res5 = mysqli_query($conn, $sql5);

														for (; $row5 = mysqli_fetch_array($res5);) {
															echo "<ul><li class='jstree-open'>" . $row5['child'];

															//복사!!!!!!!!!!!!!!!!!!!!!!!!!
															if ($row3['child'] != null) {
																$sql4 = "select * from bom where parent like '" . $row3['child'] . "'";
																$res4 = mysqli_query($conn, $sql4);

																for (; $row4 = mysqli_fetch_array($res4);) {
																	echo "<ul><li class='jstree-open'>" . $row4['child'];
																	//여기에 넣어주삼
																	echo "</li></ul>";
																}
															}
															//위까지 복사할것 끝!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
															echo "</li></ul>";
														}
													}

													echo "</li></ul>";
												}
											}
											echo "</li></ul>";
										}
									}

									echo "</li></ul>";
								}
							}
							/////////////////////////////////////////////////////////2단계 표시 끝
							echo "</li></ul>";
						}
					}

					/////////////////////////////////////////////////////////1단계 표시 끝
					echo "</li></ul>";
				}


				/////////////////////////////////////////////////////////Root 표시 끝
				echo "</li>";
			} else if ($item_code == null) {
				echo "<li>제품을 검색해주세요</li>";
			}

			?>
		</ul>
	</div>


	<form method="post" target="view_frame" action="bom_view.php">
	<div id="select_bom"></div>
	<input type="text" id="kkk">
	</form>


	<script>
		$('#tree')
			// listen for event
			.on('changed.jstree', function(e, data) {
				var i, j, r = [];
				for (i = 0, j = data.selected.length; i < j; i++) {
					r.push(data.instance.get_node(data.selected[i]).text);
				}
				//  var select_bom = $('#select_bom', parent.frames['view_frame'].document).html(r.join(', '));
				document.getElementById('kkk').value = r;
				document.getElementById('select_bom').innerHTML = r;
				
			})
			// create the instance
			.jstree();

	</script>

</body>

</html>