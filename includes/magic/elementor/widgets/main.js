let magic = new Magic(magic_wp.publishable_key_0);
let authorized = false;
const authorizedTemplate = magicSettings.templates.authorized;
const unauthorizedTemplate = magicSettings.templates.unauthorized;

// Magic Sign-in
const MagicSignIn = async () => {
  html = "";

  if (await magic.user.isLoggedIn()) {
    // console.log("User is logged in.");
    document.getElementById("magic-sign-in").innerHTML = authorizedTemplate;
  } else {
    const isLoggedIn = await magic.user.isLoggedIn();
    if (isLoggedIn) {
      document.getElementById("magic-sign-in").innerHTML = authorizedTemplate;
    }

    document.getElementById("magic-sign-in").innerHTML = unauthorizedTemplate;
  }
};

/* Login Handler */
const handleLogin = async (e) => {
  e.preventDefault();
  const redirectURI = `${window.location.origin + magic_wp.redirect_uri_0}`;
  const indexName = settings.indexName;
  const email = new FormData(e.target).get("email");
  const searchClient = algoliasearch(
    algolia.application_id,
    algolia.search_api_key
  );

  const index = searchClient.initIndex(`${indexName}`);

  const checkUserAccount = index
    .search(`${email}`, {
      hitsPerPage: 1,
    })
    .then(({ hits }) => {
      console.log(hits);

      if (hits.length <= 0) {
        alert(
          `User account for ${email} was not found. Contact support for more help.`
        );
      } else {
        magic.auth.loginWithMagicLink({ email, redirectURI });
        render();
      }
    });
};

/* Logout Handler */
const handleLogout = async () => {
  await magic.user.logout();
  window.location.href = window.location.origin;
};

document.addEventListener("DOMContentLoaded", function (event) {
  if (jQuery("#magic-sign-in").length > 0) {
    MagicSignIn();
  }
});

const MagicSignInLink = async () => {
  label = "Account";

  if (await magic.user.isLoggedIn()) {
    document.getElementById("magic-sign-in-link").innerHTML = label;
    document.getElementById("magic-sign-in-link").href =
      magic_wp.redirect_uri_0;
  } else {
    const isLoggedIn = await magic.user.isLoggedIn();
    if (isLoggedIn) {
      document.getElementById("magic-sign-in-link").innerHTML = label;
      document.getElementById("magic-sign-in-link").href =
        magic_wp.redirect_uri_0;
    }
  }
};

document.addEventListener("DOMContentLoaded", function (event) {
  if (jQuery("#magic-sign-in-link").length > 0) {
    MagicSignInLink();
  }
});

const MagicSignInRedirect = async () => {
  // TODO: Add to WP plugin settings
  if (window.location.pathname === `/sign-in/`) {
    if (await magic.user.isLoggedIn()) {
      window.location.href = magic_wp.redirect_uri_0;
    } else {
      const isLoggedIn = await magic.user.isLoggedIn();
      if (isLoggedIn) {
        window.location.href = magic_wp.redirect_uri_0;
      }
    }
  }
};

MagicSignInRedirect();
