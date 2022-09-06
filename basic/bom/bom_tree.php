<?php session_start(); ?>
<?php $conn = mysqli_connect('localhost', 'server', '00000000', 'dataset'); ?>
<?php
$parent = $_POST["parent"];
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
	<!-- CSS -->
	<link rel="stylesheet" href="css/bom_tree.css">
	<title>Document</title>
</head>

<body>
	<div class="header">
		<div class="th1">BOM 트리</div>
	</div>
	<div id="tree">
		<ul>
			<?php
			//입력한 데이터로 bom에 등록되었는지 확인
			$sql = "select * from bom where parent like '" . $parent . "'";
			$res = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($res);
			//ROOT
			echo "<li class='jstree-open' id = 'root'>" . $row['parent'];

			//1단계 CHILD
			$sql0 = "select * from bom where parent like '" . $row['parent'] . "'";
			$res0 = mysqli_query($conn, $sql0);

			for (; $row0 = mysqli_fetch_array($res0);) {
				//2단계 CHILD
				echo "<ul><li class='jstree-open'>" . $row0['child'];
				$sql1 = "select * from bom where parent like '" . $row0['child'] . "'";
				$res1 = mysqli_query($conn, $sql1);

				for (; $row1 = mysqli_fetch_array($res1);) {
					//3단계 CHILD
					echo "<ul><li class='jstree-open'>" . $row1['child'];
					$sql2 = "select * from bom where parent like '" . $row1['child'] . "'";
					$res2 = mysqli_query($conn, $sql2);

					for (; $row2 = mysqli_fetch_array($res2);) {
						echo "<ul><li class='jstree-open'>" . $row2['child'];
						$sql3 = "select * from bom where parent like '" . $row2['child'] . "'";
						$res3 = mysqli_query($conn, $sql3);

						for (; $row3 = mysqli_fetch_array($res3);) {
							echo "<ul><li class='jstree-open'>" . $row3['child'];
							$sql4 = "select * from bom where parent like '" . $row3['child'] . "'";
							$res4 = mysqli_query($conn, $sql4);

							for (; $row4 = mysqli_fetch_array($res4);) {
								echo "<ul><li class='jstree-open'>" . $row4['child'];
								$sql5 = "select * from bom where parent like '" . $row4['child'] . "'";
								$res5 = mysqli_query($conn, $sql5);

								for (; $row5 = mysqli_fetch_array($res5);) {
									echo "<ul><li class='jstree-open'>" . $row5['child'];
									$sql6 = "select * from bom where parent like '" . $row5['child'] . "'";
									$res6 = mysqli_query($conn, $sql6);

									for (; $row6 = mysqli_fetch_array($res6);) {
										echo "<ul><li class='jstree-open'>" . $row6['child'];
										$sql7 = "select * from bom where parent like '" . $row6['child'] . "'";
										$res7 = mysqli_query($conn, $sql7);

										for (; $row7 = mysqli_fetch_array($res7);) {
											echo "<ul><li class='jstree-open'>" . $row7['child'];
											$sql8 = "select * from bom where parent like '" . $row7['child'] . "'";
											$res8 = mysqli_query($conn, $sql8);

											for (; $row8 = mysqli_fetch_array($res8);) {
												echo "<ul><li class='jstree-open'>" . $row8['child'];
												$sql9 = "select * from bom where parent like '" . $row8['child'] . "'";
												$res9 = mysqli_query($conn, $sql9);

												for (; $row9 = mysqli_fetch_array($res9);) {
													echo "<ul><li class='jstree-open'>" . $row9['child'];
													$sql10 = "select * from bom where parent like '" . $row9['child'] . "'";
													$res10 = mysqli_query($conn, $sql10);

													for (; $row10 = mysqli_fetch_array($res10);) {
														echo "<ul><li class='jstree-open'>" . $row10['child'];
														$sql11 = "select * from bom where parent like '" . $row10['child'] . "'";
														$res11 = mysqli_query($conn, $sql11);

														for (; $row11 = mysqli_fetch_array($res11);) {
															echo "<ul><li class='jstree-open'>" . $row11['child'];
															$sql12 = "select * from bom where parent like '" . $row11['child'] . "'";
															$res12 = mysqli_query($conn, $sql12);

															for (; $row12 = mysqli_fetch_array($res12);) {
																echo "<ul><li class='jstree-open'>" . $row12['child'];
																/////////////////////////////////////////////////////////////////BOM이 12단계보다 길다면 아래 주석을 여기에 붙여 넣을것
																// $sql2 = "select * from bom where parent like '" . $row1['child'] . "'";
																// $res2 = mysqli_query($conn, $sql2);

																// for (; $row2 = mysqli_fetch_array($res2);) {
																// 	echo "<ul><li class='jstree-open'>" . $row2['child'];


																// }echo "</li></ul>";
																//////////////////////////////////////////////////////////////////
															}
															echo "</li></ul>";
														}
														echo "</li></ul>";
													}
													echo "</li></ul>";
												}
												echo "</li></ul>";
											}
											echo "</li></ul>";
										}
										echo "</li></ul>";
									}
									echo "</li></ul>";
								}
								echo "</li></ul>";
							}
							echo "</li></ul>";
						}
						echo "</li></ul>";
					}
					echo "</li></ul>";
				}
				echo "</li></ul>";
			}
			echo "</li>";




			// echo $row00['item_code'];
			// 			echo $sql = "select * from bom where parent like '" . $row00['item_code'] . "'";
			// 			$res = mysqli_query($conn, $sql);

			// 			/////////////////////////////////////////////////////////Root 표시
			// 			if ($row00['item_code'] != null) {
			// 				//클래스명은 검색시 펼쳐보이기 위한 옵션임
			// 				echo "<li class='jstree-open' id = 'root'>" . $row00['item_code'];

			// 				/////////////////////////////////////////////////////////1단계 표시

			// 				//Root 자식이 여러개일경우 행 개수만큼 반복
			// 				for (; $row = mysqli_fetch_array($res);) {

			// 					echo "<ul><li class='jstree-open'>" . $row['child'];

			// 					//child결과가 있을 경우 자식을 부모로 다시 검색
			// 					if ($row['child'] != null) {
			// 						$sql1 = "select * from bom where parent like '" . $row['child'] . "'";
			// 						$res1 = mysqli_query($conn, $sql1);
			// 						/////////////////////////////////////////////////////////2단계 표시
			// 						for (; $row1 = mysqli_fetch_array($res1);) {
			// 							echo "<ul><li class='jstree-open'>" . $row1['child'];

			// 							//child결과가 있을 경우 자식을 부모로 다시 검색
			// 							if ($row1['child'] != null) {
			// 								$sql2 = "select * from bom where parent like '" . $row1['child'] . "'";
			// 								$res2 = mysqli_query($conn, $sql2);

			// 								for (; $row2 = mysqli_fetch_array($res2);) {
			// 									echo "<ul><li class='jstree-open'>" . $row2['child'];

			// 									//child결과가 있을 경우 자식을 부모로 다시 검색
			// 									if ($row2['child'] != null) {
			// 										$sql3 = "select * from bom where parent like '" . $row2['child'] . "'";
			// 										$res3 = mysqli_query($conn, $sql3);

			// 										for (; $row3 = mysqli_fetch_array($res3);) {
			// 											echo "<ul><li class='jstree-open'>" . $row3['child'];

			// 											//child결과가 있을 경우 자식을 부모로 다시 검색
			// 											if ($row3['child'] != null) {
			// 												$sql4 = "select * from bom where parent like '" . $row3['child'] . "'";
			// 												$res4 = mysqli_query($conn, $sql4);

			// 												for (; $row4 = mysqli_fetch_array($res4);) {
			// 													echo "<ul><li class='jstree-open'>" . $row4['child'];

			// 													//child결과가 있을 경우 자식을 부모로 다시 검색
			// 													if ($row4['child'] != null) {
			// 														$sql5 = "select * from bom where parent like '" . $row4['child'] . "'";
			// 														$res5 = mysqli_query($conn, $sql5);

			// 														for (; $row5 = mysqli_fetch_array($res5);) {
			// 															echo "<ul><li class='jstree-open'>" . $row5['child'];

			// 															//복사!!!!!!!!!!!!!!!!!!!!!!!!!
			// 															if ($row3['child'] != null) {
			// 																$sql4 = "select * from bom where parent like '" . $row3['child'] . "'";
			// 																$res4 = mysqli_query($conn, $sql4);

			// 																for (; $row4 = mysqli_fetch_array($res4);) {
			// 																	echo "<ul><li class='jstree-open'>" . $row4['child'];
			// 																	//여기에 넣어주삼
			// 																	echo "</li></ul>";
			// 																}
			// 															}
			// 															//위까지 복사할것 끝!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			// 															echo "</li></ul>";
			// 														}
			// 													}

			// 													echo "</li></ul>";
			// 												}
			// 											}
			// 											echo "</li></ul>";
			// 										}
			// 									}

			// 									echo "</li></ul>";
			// 								}
			// 							}
			// 							/////////////////////////////////////////////////////////2단계 표시 끝
			// 							echo "</li></ul>";
			// 						}
			// 					}

			// 					/////////////////////////////////////////////////////////1단계 표시 끝
			// 					echo "</li></ul>";
			// 				}


			// 				/////////////////////////////////////////////////////////Root 표시 끝
			// 				echo "</li>";
			// 			}

			?>
		</ul>
	</div>


	<form method="post" target="view_frame" action="/basic/bom/bom_view.php">
		<input type="text" name="select_bom" id="select_bom" style="display: none;">
		<input type="submit" id="submit" style="display: none;">
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
				document.getElementById('select_bom').value = r;
				document.getElementById('submit').click();
			})
			// create the instance
			.jstree();
	</script>

</body>

</html>