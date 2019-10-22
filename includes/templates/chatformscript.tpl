
	function SetFocusMessage()
	{
		parent.frames.up.location.href=
			"{REFRESH}";
		document.cfrm.message.focus();
	}

	function setPMTo(TargUser)
	{
		document.cfrm.message.value += '/msg ' + TargUser + ":";
		document.forms[0].elements[11].focus()
	}