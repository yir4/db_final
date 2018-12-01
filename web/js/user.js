class User {
  static logout() {
    localStorage.clear();
    console.log( 'localStorage is been deleted.');
  }
}
