// scroll up

const scrollUp = () => {
    location.href = "#navbar"
  };
  
  let returnToTheTop = document.getElementById('toTheTop');
  returnToTheTop.addEventListener('click', scrollUp);