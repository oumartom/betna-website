document.addEventListener("DOMContentLoaded", () => {
  const langSelect = document.getElementById("lang-select");
  const savedLang = localStorage.getItem("lang") || "fr";

  const el = (id) => document.getElementById(id);

  const translations = {
    fr: {
      heroTitle: "Bienvenue chez Prime Betna Services",
      heroText: "Leader de la gestion immobilière et de la construction au Tchad.",
      aboutTitle: "À propos",
      aboutText: "Betna est une société spécialisée dans la gestion immobilière et les services de construction, proposant des solutions intégrales adaptées aux besoins variés des propriétaires, investisseurs et entreprises.",
      servicesTitle: "Nos Services",
      grandTitle: "Grand Standing",
      grandText: "Nos offres haut standing, finitions de luxe et emplacements premium.",
      teamTitle: "Notre Équipe",
      teamText: "Une équipe dynamique, expérimentée et passionnée.",
      projectsTitle: "Nos Réalisations",
      contactTitle: "Contactez-nous",
      navHome: "Accueil",
      navAbout: "À propos",
      navServices: "Services",
      navGrand: "Grand Standing",
      navProjects: "Réalisations",
      navTeam: "Équipe",
      navContact: "Contact"
    },
    en: {
      heroTitle: "Welcome to Prime Betna Services",
      heroText: "Leader in real estate management and construction in Chad.",
      aboutTitle: "About",
      aboutText: "Betna is a company specialized in real estate management and construction services, offering comprehensive solutions for owners, investors, and businesses.",
      servicesTitle: "Our Services",
      grandTitle: "High Standing",
      grandText: "Our premium offers, luxury finishes, and prime locations.",
      teamTitle: "Our Team",
      teamText: "A dynamic and experienced team passionate about real estate.",
      projectsTitle: "Our Projects",
      contactTitle: "Contact Us",
      navHome: "Home",
      navAbout: "About",
      navServices: "Services",
      navGrand: "High Standing",
      navProjects: "Projects",
      navTeam: "Team",
      navContact: "Contact"
    },
    ar: {
      heroTitle: "مرحبًا بكم في خدمات بيتنا",
      heroText: "رائدة في إدارة العقارات والبناء في تشاد.",
      aboutTitle: "من نحن",
      aboutText: "بيتنا شركة متخصصة في إدارة العقارات وخدمات البناء تقدم حلولًا متكاملة للمالكين والمستثمرين والشركات.",
      servicesTitle: "خدماتنا",
      grandTitle: "الفخامة العالية",
      grandText: "عروضنا الفاخرة وتشطيباتنا الراقية ومواقعنا المتميزة.",
      teamTitle: "فريقنا",
      teamText: "فريق ديناميكي يتمتع بخبرة وشغف في العقارات.",
      projectsTitle: "مشاريعنا",
      contactTitle: "اتصل بنا",
      navHome: "الرئيسية",
      navAbout: "من نحن",
      navServices: "الخدمات",
      navGrand: "الفخامة",
      navProjects: "المشاريع",
      navTeam: "الفريق",
      navContact: "اتصال"
    }
  };

  function setLanguage(lang) {
    const t = translations[lang];
    Object.keys(t).forEach(key => {
      if (el(key)) el(key).textContent = t[key];
    });

    if (lang === "ar") {
      document.documentElement.dir = "rtl";
    } else {
      document.documentElement.dir = "ltr";
    }

    localStorage.setItem("lang", lang);
  }

  langSelect.value = savedLang;
  setLanguage(savedLang);

  langSelect.addEventListener("change", (e) => {
    setLanguage(e.target.value);
  });

  // Animation slider
  const slider = document.getElementById("image-slider");
  let index = 0;
  setInterval(() => {
    index = (index + 1) % slider.children.length;
    slider.style.transform = `translateX(-${index * 100}%)`;
  }, 4000);
});
