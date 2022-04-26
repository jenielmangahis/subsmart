const relationships = [
  "Mother",
  "Father",
  "Daughter",
  "Son",
  "Sister",
  "Brother",
  "Aunt",
  "Uncle",
  "Niece",
  "Nephew",
  "Cousin",
  "Grandmother",
  "Grandfather",
  "Granddaughter",
  "Grandson",
  "Stepsister",
  "Stepbrother",
  "Stepmother",
  "Stepfather",
  "Stepdaughter",
  "Stepson",
  "Sister-in-law",
  "Brother-in-law",
  "Mother-in-law",
  "Father-in-law",
  "Daughter-in-law",
  "Son-in-law",
  "Coworker",
];

const $relationships = document.querySelectorAll("[data-type=emergency_contact_relationship]"); // prettier-ignore
$relationships.forEach(($select) => {
  $($select).select2({
    data: relationships,
    placeholder: "Select relationship",
  });

  if ($select.dataset.value) {
    $($select).val($select.dataset.value).trigger("change");
  }
});
