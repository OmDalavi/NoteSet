elements=document.querySelectorAll(".eachNote");
l=elements.length;
for(i=0;i<l;i++){
	element=elements[i];
	element.addEventListener("click",function(event){
		parentRow=event.target.parentElement;
		allTds=parentRow.children;
		
		viewNoteTitle=allTds[1].innerText;
		viewNote=allTds[2].innerText;
		viewTimestamp=allTds[3].innerText;

		document.getElementById("viewNoteTitle").innerText=viewNoteTitle;
		document.getElementById("viewNote").innerText=viewNote;
		document.getElementById("viewTimestamp").innerText=viewTimestamp;
		$("#viewNoteModal").modal('toggle');
	});
}



