export function sleep(seconds) {
  return new Promise((resolve) => setTimeout(resolve, seconds * 1000));
}

export function confirmDelete() {
  return Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#2ca01c",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete!",
  });
}
