<div class="inner">
	<p class="inner-nav">
		<a href="/" class="link">回首頁</a>
		/
		<span>遞補作業系統</span>
	</p>
	<div class="inner-subtitle">
		<p>遞補作業系統選單</p>
	</div>
	<div class="inner-content admappwait">
		<table class="inner-table" border=1>
			<tr>
				<th>選項</th>
				<th>操作</th>
			</tr>
			<tr>
				<td>放棄名單</td>
				<td><button class="action-button" onclick="window.location.href = '/?inner=admappwait_del'">查看</button></td>
			</tr>
			<tr>
				<td>抽籤名單</td>
				<td>
					<button class="action-button" onclick="window.location.href = '/?inner=admappwait_numed'">查看</button>
					<button class="action-button" onclick="window.location.href = '/?inner=admappwait_num'">前往抽籤</button>
				</td>
			</tr>
		</table>
	</div>
	<style>
		.admappwait {
			grid-template-columns: 50%;
		}

		.admappwait .inner-table {
			table-layout: auto;
		}

		.admappwait .action-button {
			padding: 0.4em 1em;
			margin-inline: 1em;
		}
	</style>
</div>