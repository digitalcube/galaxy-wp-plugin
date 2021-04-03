let magic = new Magic(magic_wp.publishable_key_0);
let authorized = false;
const authorizedTemplate = magicSettings.templates.authorized;
const unauthorizedTemplate = magicSettings.templates.unauthorized;

// Magic Sign-in
const MagicSignIn = async () => {
  html = "";
  email = "";

  if (window.location.pathname === magic_wp.redirect_uri_0) {
    try {
      await magic.auth.loginWithCredential();
      html = authorizedTemplate;
    } catch {
      window.location.href = window.location.origin;
    }
  } else {
    const isLoggedIn = await magic.user.isLoggedIn();
    html = unauthorizedTemplate;
    if (isLoggedIn) {
      if (window.location.pathname === `/sign-in/`) {
        window.location.href = `/members/account/`;
      }
      html = authorizedTemplate;
    }
  }

  if (document.getElementById("magic-sign-in")) {
    document.querySelector("#magic-sign-in").innerHTML = html;
  }
};

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
  render();
};

document.addEventListener("DOMContentLoaded", function (event) {
  if (jQuery("#magic-sign-in").length > 0) {
    MagicSignIn();
  }
});
