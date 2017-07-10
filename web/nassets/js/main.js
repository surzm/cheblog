function ready(fn) {
  if (document.readyState != 'loading'){
    fn();
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

ready(
  (function(){
    var form = document.querySelector('.js-write-us-form');
    
    if (!form) return;
    
    form.addEventListener("submit", sentFeedbackForm);
    
    function sentFeedbackForm(event) {
      event.preventDefault();
      var data = getFormData(form);
      var messageArea = document.querySelector('.js-feedback-form-message');
  
      axios.post('https://chvsk.dev.ikitlab.co/api/v1/feedback', data).then(function (response) {
        if (response.status >= 200 || response.status < 400) {
          messageArea.classList.add('fadeIn');
          messageArea.innerHTML = 'Сообщение отправлено. <br> Мы скоро ответим.'
        } else {
          messageArea.classList.add('fadeIn');
          messageArea.innerHTML = 'Что-то пошло не так. <br> Попробуйте ещё раз.'
        }
      })
    }
  })
);

ready(
  (function(){
    var form = document.querySelector('.js-form-subscription');
  
    if (!form) return;
  
    form.addEventListener("submit", subscribeEmail);
    
    function subscribeEmail(event) {
      event.preventDefault();
      var data = getFormData(form);
  
      axios.post('https://chvsk.dev.ikitlab.co/api/v1/mailinglist/subscribe ', data).then(function (response) {
        if (response.status >= 200 || response.status < 400) {
          form.classList.add('email-subscription__filed_state_sent', 'fadeIn');
          form.innerHTML = 'Спасибо за подписку'
        }
      })
    }
  })
);

// Vk Share counter

ready (
  function VkCounter() {
    var index = "1"; 
    var link = window.location.href;
    $("body").append("<script src='https://vk.com/share.php?act=count&index=" + index + "&url=" + link + "'></script>");
  }

);

var vkCounter = document.querySelector('.vk_counter'); 
var VK = {};
VK.Share = {};
VK.Share.count = function(index, count) {
    vkCounter.innerHTML = count;
};


// Fb Share counter 

ready (
    function VkCounter() {
      var fbCounter = document.querySelector('.fb_counter'); 
      var link = window.location.href;
      $.get("https://graph.facebook.com/" + link, {}, function(data) {
            fbCounter.innerHTML = data.share.share_count;
      }, 'json');
    }
  );
