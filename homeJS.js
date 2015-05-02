function toggleBanner()
{
	var seen = document.getElementById("banner");
	
	if (seen.style.display == "none")
	{
		document.getElementById("banner").style.display = "block";
	} 
	else
	{
		document.getElementById("banner").style.display = "none";
	}
}

function toggleAbout()
{
	var seen = document.getElementById("about");
	
	if (seen.style.display == "none")
	{
		document.getElementById("about").style.display = "block";
	} 
	else
	{
		document.getElementById("about").style.display = "none";
	}
}