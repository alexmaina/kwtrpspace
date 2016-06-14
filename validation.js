/*****************************************************************************
/*Copyright (C) 2016 Alex Maina Mwangi
/*****************************************************************************
(KWTRPSPACE Version 1.0), is Manuscript management information system
designed to manage manuscripts from conception to publication in peer-reviewed journals.
This program is free software; you can redistribute it and/or modify it under the terms
of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License,
or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with this program;
if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA or 
check for license.txt at the root folder
/*****************************************************************************
For any details please feel free to contact me at afroscholar@users.sourceforge.net
Or for snail mail. P. O. Box 71044,Nairobi-00610, East Africa-Kenya.
/*****************************************************************************/

$(function() {
    		var date = $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();

  	});


	function ValidateLogin(){
			var username = document.forms["login"]["username"].value;
			var password = document.forms["login"]["password"].value;
				if (username == null || username ==""){
					alert ("username cannot be empty");
					return false;
					}
			if (password == null || password ==""){
					alert ("password cannot be empty");
					return false;
					}
	}



	function ValidateForm(){
			
			var authors = document.forms["myForm"]["authors"].value;
			var title = document.forms["myForm"]["title"].value;
			var month = document.forms["myForm"]["month"].value;
			var year = document.forms["myForm"]["year"].value;
			var abstract = document.forms["myForm"]["abstract"].value;
			var date_of_circulation = document.forms["myForm"]["date_of_circulation"].value;
			var keywords = document.forms["myForm"]["keywords"].value;
			


				

				if (authors == null || authors ==""){
					alert ("author names cannot be empty");
					return false;
					}
				if (title == null || title ==""){
					alert ("title cannot be empty");
					return false;
					}
				
				if(month == null || month ==""){
					alert ("month must be selected");
					return false;
					}
				
				if(year == null || year ==""){
					alert ("year must be selected");
					return false;
					}
				if(abstract== null || abstract ==""){
					alert ("abstract cannot be left empty");
					return false;
					}

				
				if (keywords == null || keywords == ""){
					alert ("You have to enter atleast two keywords");
					return false;
					
				}
				if (date_of_circulation == null || date_of_circulation ==""){
					alert ("You have to select the date the manuscript was circulated");
					return false;
				}


}

function addsupp(){
    			var input =document.createElement('input');
    			input.type="file";
    			document.getElementById('button').appendChild(input);
}			

