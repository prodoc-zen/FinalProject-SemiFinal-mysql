function goToBrowseTutor() 
        {
            // Switch to Carousel item #2 (index starts at 0)
            const myCarousel = document.querySelector('#dashboardCarousel');
            const carousel = bootstrap.Carousel.getOrCreateInstance(myCarousel);

            carousel.to(1); // Go to second slide

            document.getElementById('overviewLink').classList.remove('active');
            document.getElementById('sessionsLink').classList.remove('active');
            document.getElementById('browseLink').classList.add('active');
        }

        function goToOverview() 
        {
            // Switch to Carousel item #2 (index starts at 0)
            const myCarousel = document.querySelector('#dashboardCarousel');
            const carousel = bootstrap.Carousel.getOrCreateInstance(myCarousel);

            carousel.to(0); // Go to first slide

            document.getElementById('overviewLink').classList.add('active');
            document.getElementById('browseLink').classList.remove('active');
            document.getElementById('sessionsLink').classList.remove('active');
        }

        function goToSessions() 
        {
            // Switch to Carousel item #2 (index starts at 0)
            const myCarousel = document.querySelector('#dashboardCarousel');
            const carousel = bootstrap.Carousel.getOrCreateInstance(myCarousel);

            carousel.to(2); // Go to third slide

            document.getElementById('sessionsLink').classList.add('active');
            document.getElementById('browseLink').classList.remove('active');
            document.getElementById('overviewLink').classList.remove('active');
        }