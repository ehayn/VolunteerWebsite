<div class="tab-pane" id="viewDatabase">
	<div class="container theme-showcase" role="main">
		<div class="jumbotron">
			<h1>View/Search Form</h1>
			<p>Search for data below.</p>
		</div>
		<div style="width:75%;margin:0 auto;">
			<form id="searchForm" name="searchForm">
				<div class="input-group">
					<span class="input-group-addon">Search for</span>
					<select id="firstType" style="width:100%;height:35px" name = "firstType" onchange="setOptions(document.searchForm.firstType.options[document.searchForm.firstType.selectedIndex].value);">
						<option value="con">Contacts</option>
						<option value="org">Organizations</option>
					</select>
					<span class="input-group-addon">by</span>
					<select id="secondType" style="width:100%;height:35px" name = "secondType">
						<option value="con1">First Name</option>
						<option value="con2">Last Name</option>
						<option value="con3">City</option>
						<option value="con4">State</option>
						<option value="con5">Status</option>
						<option value="con6">Organization</option>
					</select>
					<span class="input-group-addon">:</span>
					<input style="width:100%;height:35px" type="text" id="searchInput" onkeyup="showHintFunction()" list="names"/>
					<datalist id="names">
					</datalist>
					<span class="input-group-btn">
						<button class="btn btn-default" name="enter4" id="requestResults" type="button">Get Results</button>
					</span>
				</div>
				<br />
				<div class="input-group">
					<span class="input-group-addon">Retrieve All Data for:</span>
					<span class="input-group-btn">
						<button style="width:100%" class="dataTableButton btn btn-default" value="con" name="enter4" id="conDataTable" type="button">Contacts</button>
					</span>
					<span class="input-group-btn">
						<button style="width:100%" class="dataTableButton btn btn-default" value="org" name="enter4" id="orgDataTable" type="button">Organizations</button>
					</span>
					<span class="input-group-btn">
						<button style="width:100%" class="dataTableButton btn btn-default" value="use" name="enter4" id="useDataTable" type="button">Users</button>
					</span>
				</div>
			</form>
		</div>
		<br />
		<div id="searchResults" style="width:100%;margin:0 auto;">
		</div>
		<div id="dataTablesSearchResults" style="width:100%;margin:0 auto;">
		</div>
	</div>
</div>