// import "https://formio.github.io/formio.js/#";


const formBaseUrl = "/nsmartrac/"; // loc al
// const formBaseUrl = `${window.location.origin}/` ; // online

// =====================================
//            GLOBAL VALUES
// =====================================

const elementsList = [
  {
    id: 1,
    type: "radio-button",
    category: 'common'
  },
  {
    id: 2,
    type: "dropdown",
    category: 'common'
  },
  {
    id: 3,
    type: "checkbox",
    category: 'common'
  },
  {
    id: 4,
    type: "email-address",
    category: 'common'
  },
  {
    id: 5,
    type: "long-answer",
    category: 'common'
  },
  {
    id: 6,
    type: "short-answer",
    category: 'common'
  },
  {
    id: 7,
    type: "calendar",
    category: 'common'
  },
  {
    id: 8,
    type: "number",
    category: 'common'
  },
  {
    id: 9,
    type: "file-upload",
    category: 'common'
  },
  {
    id: 10,
    type: "text-list",
    category: 'common'
  },
  {
    id: 11,
    type: "rating",
    category: 'common'
  },
  {
    id: 12,
    type: "ranking",
    category: 'common'
  },
  {
    id: 13,
    type: "hidden-field",
    category: 'common'
  },
  {
    id: 14,
    type: "signature",
    category: 'common'
  },
  {
    id: 15,
    type: "image-list",
    category: 'common'
  },
  {
    id: 16,
    type: "calculation",
    category: 'common'
  },
  {
    id: 17,
    type: "credit-card",
    category: 'common'
  },
  {
    id: 18,
    type: "contact-block",
    category: 'common'
  },
  {
    id: 19,
    type: "save-and-return",
    category: 'common'
  },
  {
    id: 20,
    type: "heading",
    category: 'format'
  },
  {
    id: 21,
    type: "formatted-text",
    category: 'format'
  },
  {
    id: 22,
    type: "image",
    category: 'format'
  },
  {
    id: 23,
    type: "link",
    category: 'format'
  },
  {
    id: 24,
    type: "custom-code",
    category: 'format'
  },
  {
    id: 25,
    type: "blank-space",
    category: 'format'
  },
  {
    id: 26,
    type: "page-break",
    category: 'format'
  },
  {
    id: 28,
    type: "radio-button-email-routing",
    category: 'email'
  },
  {
    id: 29,
    type: "dropdown-email-routing",
    category: 'email'
  },
  {
    id: 30,
    type: "checkbox-email-routing",
    category: 'email'
  },
]


// =====================================
//            EDIT PAGE
// =====================================
