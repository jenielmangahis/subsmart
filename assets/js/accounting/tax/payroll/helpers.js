// https://stackoverflow.com/a/6394197/8062659
export function Accounting__getValue(object, selector) {
  const parts = selector.split(".");
  const newObj = object[parts[0]];

  if (!parts[1]) {
    return newObj;
  }

  parts.splice(0, 1);
  const nextSelector = parts.join(".");
  return Accounting__getValue(newObj, nextSelector);
}
