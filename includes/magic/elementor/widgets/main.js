let magic = new Magic(magic_wp.publishable_key_0);
let authorized = false;
const authorizedTemplate = magicSettings.templates.authorized;
const unauthorizedTemplate = magicSettings.templates.unauthorized;

// Check if user is logged in.
const MagicSignIn = async () => {
  document.querySelector("#magic-sign-in").innerHTML = unauthorizedTemplate;
  html = "";
  email = "";

  try {
    await magic.auth.loginWithCredential();
    // State: User is logged in.
    console.log("// State: User is logging in.");
    if (window.location.pathname === `/sign-in/`) {
      // Redirect authenticated user to a page.
      // TODO: Make this an option in WP.
      window.location.href = magic_wp.redirect_uri_0;
    }

    // State: User is authenticated.
    console.log("// State: User is authenticated.");
    document.querySelector("#magic-sign-in").innerHTML = authorizedTemplate;
  } catch {
    // State: User is NOT logging in.
    console.log("// State: User is NOT logging in.");
    const isLoggedIn = await magic.user.isLoggedIn();
    if (isLoggedIn) {
      // State: Logged in.
      console.log("// State: Logged in.");
      if (window.location.pathname === `/sign-in/`) {
        // Redirect authenticated user to a page.
        // TODO: Make this an option in WP.
        window.location.href = magic_wp.redirect_uri_0;
      }
    } else {
      // State: Not logged in.
      console.log("// State: Not logged in.", magic_wp.redirect_uri_0);
      if (window.location.pathname === magic_wp.redirect_uri_0) {
        // Redirect authenticated user to a page.
        // TODO: Make this an option in WP.
        window.location.href = `/sign-in/`;
      }
    }
  }
};

document.addEventListener("DOMContentLoaded", function (event) {
  if (jQuery("#magic-sign-in").length > 0) {
    MagicSignIn();
  }
});

if (jQuery("#magic-sign-in").length > 0) {
  MagicSignIn();
}

/* Login Handler */
const handleLogin = async (e) => {
  e.preventDefault();
  const email = new FormData(e.target).get("email");
  const redirectURI = `${window.location.origin + magic_wp.redirect_uri_0}`;
  if (email) {
    await magic.auth.loginWithMagicLink({ email, redirectURI });
    render();
  }
};

/* Logout Handler */
const handleLogout = async () => {
  await magic.user.logout();
  window.location.href = window.location.origin;
};
