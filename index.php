<html>
<head>
<title>Famous Ethiopian Albums</title>
<style>
	
    .track{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }
    .pic img{
	max-width:50px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">
/*
				"Album":2,
				"Title":"Chal Zendro",				
				"ArtistName ":"Dawit Tsige",
       	"Year":2020,
				"FavoriteTrack":"Wude Wude",			
				"Image":"skyfall.jpg"
*/
function trackTemplate(track) {
  return`
        <div class= "track"> 
        <b>Album</b>: ${track.Album}<br />
        <b>Title</b>: ${track.Title}<br/> 
        <b>Artist Name</b>: ${track.ArtistName}<br /> 
        <b>Year</b>: ${track.Year}<br />         
        <b>Favorite Track</b>: ${track.FavoriteTrack}<br />           
        <div class="pic"><img src= "thumbnails/${track.Image}" /></div>    
        </div>
  `;  
}

  
$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);

     //place data.title on page
     $("#albumtitle").html(data.title);

     //clear previous films
     $("#albums").html("");

     //loop through data,films and place on page
     $.each(data.tracks, function(i,item){
          let myData = trackTemplate(item);
          $("<div></div>").html(myData).appendTo("#albums");
       
     });
     
    /*
     let myData = JSON.stringify(data, null, 4);
     myData = "<pre>" + myData + "</pre>";
     $("#output").html(myData);     
     */
   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
 
  });
}); 
</script>
</head>
	<body>
	<h1>Famous Ethiopian Albums</h1>
		<a href="track" class="category">Famous Ethiopian Albums By Favorite Track</a><br />
		<a href="year" class="category">Famous Ethiopian Albums By Release Year</a>
		<h3 id="albumtitle">Famous Ethiopian Albums</h3>
		<div id="albums">		</div>
      <p>In this Web Service Project, I used Famous Ethiopian Albums as my topic to create my own web service. I was able to find data that I could copy into a spreadsheet and use it to enter and sort the main data, prior to creating the JSON files.</p>
    <p>My web service features 10 JSON items and has 5 properties per item. I also used images that are associated with each item. I used jQuery with wiring to a click event on tags with a class of category. The items are delivered by AJAX.</p>
    <p>The following properties are apply for each item:</p>
    <ul>
        <li>Album Number</li>
        <li>Album Title</li>
        <li>Artist Name</li>
        <li>Release Year</li>
        <li>Favorite Track</li>
        <li>Artist Photo</li>
    </ul>
    <p> The items are, then, sorted by the Release Years and my Favorite Tracks. </p>    
	</body>
</html>
