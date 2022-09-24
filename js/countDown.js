let countdown = setInterval(function(){
    let now = new Date()
    let target = new Date(js_regist_time)
    let remainTime = target - now

    if(remainTime < 0) {
      location.reload()
      return false
    }


    let difHour = Math.floor(remainTime / 1000 / 60 / 60 ) % 24
    let difMin  = Math.floor(remainTime / 1000 / 60) % 60
    let difSec  = Math.floor(remainTime / 1000) % 60


    document.getElementById("hour").innerHTML = difHour + "時間"
    document.getElementById("hour").style.color = "red";
    document.getElementById("min").innerHTML = difMin + "分"
    document.getElementById("min").style.color = "red";
    document.getElementById("sec").innerHTML = difSec + "秒"
    document.getElementById("sec").style.color = "red";


    if(remainTime < 0) clearInterval(countdown)

}, 1000)
