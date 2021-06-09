/* function hackvengersCarousel(article){


    let images = [];

    for (let i = 1; i <= 5; i++) {
      images.push(article['images'][0]['img' + i]);
    }

    let wrapper = document.querySelector("#staffWrapper");

    images.forEach((member) => {
      wrapper.innerHTML+=`
          <div class="col-md-2 col-sm-6 mb-4">
              <a>
                  <img class="member" class="img-fluid" src="${member}200" alt="">
              </a>
          </div>
          `;
    });
    let members = document.querySelectorAll(".member");
    let placeholder;
    let splitholder;
    for (let i = 0; i < members.length; i++) {
      members[i].addEventListener("click",()=>{
          img = members[i];
          placeholder = img.getAttribute('src');
          splitholder=placeholder.split('/');



          splitholder[3] = '';
          placeholder = splitholder.join('/');
          console.log(placeholder);

          let wra = document.querySelector("#wrapper");

          wra.innerHTML= `<img class="member" class="img-fluid" src="${placeholder}500" alt="">`;

      });
    };
}
 */
