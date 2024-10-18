document.addEventListener("DOMContentLoaded", function () {
  //create blogs button
  const addBlogsButton = document.getElementById("create-blog-button");

  const formSection = document.getElementById("create-blogs-section");

  const introduction = `
  <div class='introduction-container'>
  <h3>Introduction</h3>
  <div class='introduction-border'>
   <input type='text' name='introtitle' placeholder='title' for='intro-title'>
   
   <div class='intro-input-container'>
      <input type='text' name='introcategory' placeholder='category' for='intro-category'>
      <input type='date' name='introdate' placeholder='date' for='intro-date'>
   </div>

    <div class='intro-image-container'>
    <img src='./assets/icons/image.svg' height='60' >
    <input type="file" for='intro-image' >
    </div>

    <textarea class='introduction-text-area' name='introcontent' placeholder='introduction content' rows=5 ></textarea>

  
  </div>
  
  </div>
  `;

  const Header = `
    <div class='header-container'>
    <h3>Header</h3>
    <div class='header-border'>
    <input type='text' name='header' placeholder='header' for='header'>
    </div>
  </div>
    `;

  const Paragraph = `
       <div class='header-container'>
    <h3>Paragraph</h3>
    <div class='header-border'>
    <input type='text' name='paragraph' placeholder='paragraph' for='header'>
    </div>
  </div>`;

  const Image = ` <div class='image-container'>
    <h3>Image</h3>
    <div class='image-border'>
     <img src='./assets/icons/image.svg' height='60' >
   <input type='file' name='image' placeholder='image'>
    </div>
    </div>`;

  const Section = `
    <div class='section-container'>
    <h3>Section</h3>
    <div class='section-border'>
      <input type='text' name='sectiontitle' placeholder='sectiontitle' for='section'>
<div class='section-img-container'>
    <img src='./assets/icons/image.svg' height='60' >
   <input type='file' name='image' placeholder='image'>
   </div>

   <textarea class='text-area' name='sectioncontent' placeholder='section content' rows=5 ></textarea>
    </div>
    </div>
    `;

  const htmlList = [introduction, Header, Paragraph, Image, Section];

  formSection.innerHTML += htmlList[0];

  addBlogsButton.childNodes.forEach(function (element) {
    element.addEventListener("click", function (e) {
      element.childNodes.forEach(function (tag) {
        if (tag.tagName === "P") {
          switch (tag.innerHTML) {
            case "Header":
              formSection.innerHTML += htmlList[1];
              break;
            case "Paragraph":
              formSection.innerHTML += htmlList[2];
              break;
            case "Image":
              formSection.innerHTML += htmlList[3];
              break;
            case "Section":
              formSection.innerHTML += htmlList[4];
              break;
          }
        }
      });
    });
  });
});
