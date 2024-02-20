// i18n.js
import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';
import enTranslation from './en.json';
import inTranslation from './in.json';

i18n
  .use(initReactI18next)
  .init({
    resources: {
      en: {
        translation: enTranslation,
      },
      in: {
        translation: inTranslation,
      },
    },
    lng: 'en', // Default language
    fallbackLng: 'en', // Fallback language
    interpolation: {
      escapeValue: false, // React already does escaping
    },
  });

export default i18n;
