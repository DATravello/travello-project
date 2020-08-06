const navbar = document.querySelector(".navbar");
const sectionOne = document.querySelector(".banner");

const sectionOneOptions = {
    rootMargin: "-550px 0px 0px 0px"
};

const sectionOneObserver = new IntersectionObserver
(function(
    entries,
    sectionOneObserver
)   {
    entries.forEach(entry => 
        {
            if (!entry.isIntersecting) 
            {
                navbar.classList.add("navbar-scrolled");
            }
            else
            {
                navbar.classList.remove("navbar-scrolled");
            }
        });
    },
sectionOneOptions);

sectionOneObserver.observe(sectionOne);