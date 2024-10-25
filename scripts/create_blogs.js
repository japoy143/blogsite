document.addEventListener("DOMContentLoaded", function () {
  const images = "./assets/icons/image.svg";

  //create blogs button
  const addBlogsButton = document.getElementById("create-blog-button");

  const formSection = document.getElementById("create-blogs-section");

  //positions holder
  const positionsHolder = document.getElementById("positions-holder");

  const saveButton = document.getElementById("save-button");

  const introduction = `
  <div class='introduction-container'>
  <h3>Introduction</h3>
  <div class='introduction-border'>
   <input type='text' name='introtitle' placeholder='title' for='intro-title'>
   
   <div class='intro-input-container'>
      <input type='text' name='introcategory' placeholder='category' for='intro-category'>
      <input type='text' name='introsubtitle' placeholder='subtitle' for='intro-category'>
   </div>

    <div class='intro-image-container'>
    <img src="${images}" height='60' >

    <input type="file" for='intro-image' name='introimg'>
    </div>

    <textarea class='introduction-text-area' name='introcontent' placeholder='introduction content' rows=5 ></textarea>

  
  </div>
 
  </div>
  `;

  let headerCounter = 0;

  const Header = `
    <div class='header-container'>
    <h3>Header</h3>
    <div class='header-border'>
    <input type='text' name='header${headerCounter}' placeholder='header' for='header'>
    </div>
     
  </div>
    `;

  let paragraphCounter = 0;

  const Paragraph = `
       <div class='header-container'>
    <h3>Paragraph</h3>
    <div class='header-border'>
    <input type='text' name='paragraph${paragraphCounter}' placeholder='paragraph' for='header'>
    </div>
   
  </div>`;

  let imageCounter = 0;

  const Image = ` <div class='image-container'>
    <h3>Image</h3>
    <div class='image-border'>
     <img src="${images}" height='60' >
   <input type='file' name='image${imageCounter}' placeholder='image'>
    </div>

    </div>`;

  let sectionCounter = 0;

  const Section = `
    <div class='section-container'>
    <h3>Section</h3>
    <div class='section-border'>
      <input type='text' name='sectiontitle${sectionCounter}' placeholder='sectiontitle' for='section'>
<div class='section-img-container'>
    <img src="${images}" height='60' >
   <input type='file' name='sectionimage${sectionCounter}' placeholder='image'>
   </div>

   <textarea class='text-area' name='sectioncontent${sectionCounter}' placeholder='section content' rows=5 ></textarea>
    </div>

    </div>
    `;

  const htmlList = [introduction, Header, Paragraph, Image, Section];
  formSection.innerHTML += htmlList[0];

  let blogPostions = [0];

  function updateBlogPostion(blogpos) {
    document.cookie = `blogposition=${encodeURIComponent(blogpos)}`;
  }

  updateBlogPostion(blogPostions);

  addBlogsButton.childNodes.forEach(function (element) {
    element.addEventListener("click", function (e) {
      element.childNodes.forEach(function (tag) {
        if (tag.tagName === "P") {
          switch (tag.innerHTML) {
            case "Header":
              blogPostions.push(1);
              formSection.innerHTML += htmlList[1];
              headerCounter++;
              updateBlogPostion(blogPostions);
              break;
            case "Paragraph":
              blogPostions.push(2);
              formSection.innerHTML += htmlList[2];
              paragraphCounter++;
              updateBlogPostion(blogPostions);
              break;
            case "Image":
              blogPostions.push(3);
              formSection.innerHTML += htmlList[3];
              imageCounter++;
              updateBlogPostion(blogPostions);
              break;
            case "Section":
              blogPostions.push(4);
              formSection.innerHTML += htmlList[4];
              sectionCounter++;
              updateBlogPostion(blogPostions);
              break;
          }
        }
      });
    });
  });
});
