const lists = document.querySelectorAll('ul');
const courseBtn = document.querySelectorAll('.select__title-course');
const topicBtn = document.querySelectorAll('.select__title-topic');
const subtopicBtn = document.querySelectorAll('.select__title-subtopic');
const questionBtn = document.querySelectorAll('.select__title-question');
lists.forEach((item) => {

    let children = item.querySelectorAll('ul');
   for (let i = 0; i < children.length; i++) {
      children[i].parentElement.classList.add('hide');
      
   }
   children.forEach((ul)=>{
    ul.classList.add('hide');
  });
   
});


function toggleClassToList(selector) {
    selector.forEach((item)=>{
        item.addEventListener('click',()=>{
            console.log(item);
            
            item.nextElementSibling.classList.toggle('show');
            
        });
    });
}


toggleClassToList(courseBtn);
toggleClassToList(topicBtn);
toggleClassToList(subtopicBtn);
toggleClassToList(questionBtn);