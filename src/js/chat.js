const form = document.querySelector(".typing-area"),
    input = document.querySelector(".typing-input"),
    incoming_id = document.querySelector(".incoming_id").value,
    send = document.querySelector(".typing-send"),
    chatbox = document.querySelector(".chat-box");

    function scrollToBottom(){
        chatbox.scrollTop = chatbox.scrollHeight;
      }
      
    form.onsubmit = (e)=>{
        e.preventDefault();
    }
    input.focus();
input.onkeyup = ()=>{
    if(input.value != ""){
        send.classList.add("active");
    }else{
        send.classList.remove("active");
    }
}
    
    send.onclick = ()=>{
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "/blue-pearl/src/php/insert-chat.php", true);
      xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                input.value = "";
                scrollToBottom();
            }
        }
      }
      let formData = new FormData(form);
      xhr.send(formData);
  }


  chatbox.onmouseenter = ()=>{
    chatbox.classList.add("active");
}

chatbox.onmouseleave = ()=>{
    chatbox.classList.remove("active");
}
function scrollToBottom(){
    chatbox.scrollTop = chatbox.scrollHeight;
  }


  setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/blue-pearl/src/php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatbox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);
