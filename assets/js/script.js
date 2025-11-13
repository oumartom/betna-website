// Changement de langue simple
const translations = {
  en: {
    home: "Home",
    about: "About",
    services: "Services",
    team: "Team",
    projects: "Projects",
    contact: "Contact",
    hero_title: "Prime Betna Services",
    hero_desc: "The real estate leader in Chad since 2021."
  },
  ar: {
    home: "الرئيسية",
    about: "من نحن",
    services: "الخدمات",
    team: "الفريق",
    projects: "المشاريع",
    contact: "اتصل بنا",
    hero_title: "شركة بيتنا للخدمات",
    hero_desc: "الرائدة في إدارة العقارات في تشاد منذ عام 2021."
  },
  fr: {
    home: "Accueil",
    about: "À propos",
    services: "Services",
    team: "Équipe",
    projects: "Réalisations",
    contact: "Contact",
    hero_title: "Prime Betna Services",
    hero_desc: "Le leader de la gestion immobilière au Tchad depuis 2021."
  }
};

document.getElementById('languageSwitcher').addEventListener('change', function() {
  const lang = this.value;
  document.querySelectorAll('[data-key]').forEach(el => {
    const key = el.getAttribute('data-key');
    el.textContent = translations[lang][key];
  });
});
