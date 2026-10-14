/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ 237:
/***/ (function(__unused_webpack_module, __unused_webpack___webpack_exports__, __webpack_require__) {


;// CONCATENATED MODULE: ./src/main/js/util/path.js
function combinePath(pathOne, pathTwo) {
  let queryParams;
  let i = pathOne.indexOf("?");
  if (i >= 0) {
    queryParams = pathOne.substring(i);
  } else {
    queryParams = "";
  }
  i = pathOne.indexOf("#");
  if (i >= 0) {
    pathOne = pathOne.substring(0, i);
  }
  if (pathOne.endsWith("/")) {
    return pathOne + pathTwo + queryParams;
  }
  return pathOne + "/" + pathTwo + queryParams;
}
/* harmony default export */ var path = ({
  combinePath
});
;// CONCATENATED MODULE: ./src/main/js/util/behavior-shim.js
function specify(selector, id, priority, behavior) {
  // eslint-ignore-next-line
  Behaviour.specify(selector, id, priority, behavior);
}
function applySubtree(startNode, includeSelf) {
  // eslint-ignore-next-line
  Behaviour.applySubtree(startNode, includeSelf);
}
/* harmony default export */ var behavior_shim = ({
  specify,
  applySubtree
});
;// CONCATENATED MODULE: ./src/main/js/util/dom.js
function createElementFromHtml(html) {
  const template = document.createElement("template");
  template.innerHTML = html.trim();
  return template.content.firstElementChild;
}
function toId(string) {
  return string.trim().replace(/[\W_]+/g, "-").toLowerCase();
}
;// CONCATENATED MODULE: ./src/main/js/util/security.js
function xmlEscape(str) {
  return str.replace(/[<>&'"]/g, match => {
    switch (match) {
      case "<":
        return "&lt;";
      case ">":
        return "&gt;";
      case "&":
        return "&amp;";
      case "'":
        return "&apos;";
      case '"':
        return "&quot;";
    }
  });
}

;// CONCATENATED MODULE: ./src/main/js/components/dropdowns/templates.js


function dropdown() {
  return {
    content: "<p class='jenkins-spinner'></p>",
    interactive: true,
    trigger: "click",
    allowHTML: true,
    placement: "bottom-start",
    arrow: false,
    theme: "dropdown",
    appendTo: document.body,
    offset: [0, 0],
    animation: "dropdown",
    onShow: instance => {
      const referenceParent = instance.reference.parentNode;
      if (referenceParent.classList.contains("model-link")) {
        referenceParent.classList.add("model-link--open");
      }
    },
    onHide: instance => {
      const referenceParent = instance.reference.parentNode;
      referenceParent.classList.remove("model-link--open");
    }
  };
}
function menuItem(options) {
  const itemOptions = Object.assign({
    type: "link"
  }, options);
  const label = xmlEscape(itemOptions.label);
  let badgeText;
  let badgeTooltip;
  if (itemOptions.badge) {
    badgeText = xmlEscape(itemOptions.badge.text);
    badgeTooltip = xmlEscape(itemOptions.badge.tooltip);
  }
  const tag = itemOptions.type === "link" ? "a" : "button";
  const item = createElementFromHtml(`
      <${tag} class="jenkins-dropdown__item" href="${itemOptions.url}">
          ${itemOptions.icon ? `<div class="jenkins-dropdown__item__icon">${itemOptions.iconXml ? itemOptions.iconXml : `<img alt="${label}" src="${itemOptions.icon}" />`}</div>` : ``}
          ${label}
                    ${itemOptions.badge != null ? `<span class="jenkins-dropdown__item__badge" tooltip="${badgeTooltip}">${badgeText}</span>` : ``}
          ${itemOptions.subMenu != null ? `<span class="jenkins-dropdown__item__chevron"></span>` : ``}
      </${tag}>
    `);
  if (options.onClick) {
    item.addEventListener("click", event => options.onClick(event));
  }
  return item;
}
function heading(label) {
  return createElementFromHtml(`<p class="jenkins-dropdown__heading">${label}</p>`);
}
function separator() {
  return createElementFromHtml(`<div class="jenkins-dropdown__separator"></div>`);
}
function placeholder(label) {
  return createElementFromHtml(`<p class="jenkins-dropdown__placeholder">${label}</p>`);
}
function disabled(label) {
  return createElementFromHtml(`<p class="jenkins-dropdown__disabled">${label}</p>`);
}
/* harmony default export */ var templates = ({
  dropdown,
  menuItem,
  heading,
  separator,
  placeholder,
  disabled
});
;// CONCATENATED MODULE: ./src/main/js/util/keyboard.js
/**
 * @param {Element} container - the container for the items
 * @param {function(): NodeListOf<Element>} itemsFunc - function which returns the list of items
 * @param {string} selectedClass - the class to apply to the selected item
 * @param {function()} additionalBehaviours - add additional keyboard shortcuts to the focused item
 * @param hasKeyboardPriority - set if custom behaviour is needed to decide whether the element has keyboard priority
 */
function makeKeyboardNavigable(container, itemsFunc, selectedClass) {
  let additionalBehaviours = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : () => {};
  let hasKeyboardPriority = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : () => window.getComputedStyle(container).visibility === "visible";
  window.addEventListener("keyup", e => {
    let items = Array.from(itemsFunc());
    let selectedItem = items.find(a => a.classList.contains(selectedClass));
    if (container && hasKeyboardPriority(container)) {
      if (e.key === "Tab") {
        if (items.includes(document.activeElement)) {
          if (selectedItem) {
            selectedItem.classList.remove(selectedClass);
          }
          selectedItem = document.activeElement;
          selectedItem.classList.add(selectedClass);
        }
      }
    }
  });
  window.addEventListener("keydown", e => {
    let items = Array.from(itemsFunc());
    let selectedItem = items.find(a => a.classList.contains(selectedClass));

    // Only navigate through the list of items if the container is active on the screen
    if (container && hasKeyboardPriority(container)) {
      if (e.key === "ArrowDown") {
        e.preventDefault();
        if (selectedItem) {
          selectedItem.classList.remove(selectedClass);
          const next = items[items.indexOf(selectedItem) + 1];
          if (next) {
            selectedItem = next;
          } else {
            selectedItem = items[0];
          }
        } else {
          selectedItem = items[0];
        }
        scrollAndSelect(selectedItem, selectedClass, items);
      } else if (e.key === "ArrowUp") {
        e.preventDefault();
        if (selectedItem) {
          selectedItem.classList.remove(selectedClass);
          const previous = items[items.indexOf(selectedItem) - 1];
          if (previous) {
            selectedItem = previous;
          } else {
            selectedItem = items[items.length - 1];
          }
        } else {
          selectedItem = items[items.length - 1];
        }
        scrollAndSelect(selectedItem, selectedClass, items);
      } else if (e.key === "Enter") {
        if (selectedItem) {
          e.preventDefault();
          selectedItem.click();
        }
      } else {
        additionalBehaviours(selectedItem, e.key);
      }
    }
  });
}
function scrollAndSelect(selectedItem, selectedClass, items) {
  if (selectedItem !== null) {
    if (!isInViewport(selectedItem)) {
      selectedItem.scrollIntoView(false);
    }
    selectedItem.classList.add(selectedClass);
    if (items.includes(document.activeElement)) {
      selectedItem.focus();
    }
  }
}
function isInViewport(element) {
  const rect = element.getBoundingClientRect();
  return rect.top >= 0 && rect.left >= 0 && rect.bottom <= window.innerHeight && rect.right <= window.innerWidth;
}
// EXTERNAL MODULE: ../../../../../.yarn/berry/cache/tippy.js-npm-6.3.7-424f946d38-10c0.zip/node_modules/tippy.js/dist/tippy.esm.js + 16 modules
var tippy_esm = __webpack_require__(9934);
;// CONCATENATED MODULE: ./src/main/js/components/dropdowns/utils.js




const SELECTED_ITEM_CLASS = "jenkins-dropdown__item--selected";

/*
 * Generates the dropdowns for the given element
 * Preloads the data on hover for speed
 * @param element - the element to generate the dropdown for
 * @param callback - called to retrieve the list of dropdown items
 */
function generateDropdown(element, callback) {
  (0,tippy_esm/* default */.ZP)(element, Object.assign({}, templates.dropdown(), {
    onCreate(instance) {
      instance.reference.addEventListener("mouseenter", () => {
        if (instance.loaded) {
          return;
        }
        instance.popper.addEventListener("click", () => {
          instance.hide();
        });
        callback(instance);
      });
    },
    onShown(instance) {
      behavior_shim.applySubtree(instance.popper);
    }
  }));
}

/*
 * Generates the contents for the dropdown
 */
function generateDropdownItems(items, compact) {
  const menuItems = document.createElement("div");
  menuItems.classList.add("jenkins-dropdown");
  if (compact === true) {
    menuItems.classList.add("jenkins-dropdown--compact");
  }
  items.map(item => {
    if (item.type === "HEADER") {
      return templates.heading(item.label);
    }
    if (item.type === "SEPARATOR") {
      return templates.separator();
    }
    if (item.type === "DISABLED") {
      return templates.disabled(item.label);
    }
    const menuItem = templates.menuItem(item);
    if (item.subMenu != null) {
      (0,tippy_esm/* default */.ZP)(menuItem, Object.assign({}, templates.dropdown(), {
        content: generateDropdownItems(item.subMenu()),
        trigger: "mouseenter",
        placement: "right-start",
        offset: [-8, 0]
      }));
    }
    return menuItem;
  }).forEach(item => menuItems.appendChild(item));
  if (items.length === 0) {
    menuItems.appendChild(templates.placeholder("No items"));
  }
  makeKeyboardNavigable(menuItems, () => menuItems.querySelectorAll(".jenkins-dropdown__item"), SELECTED_ITEM_CLASS, (selectedItem, key) => {
    switch (key) {
      case "ArrowLeft":
        {
          const root = selectedItem.closest("[data-tippy-root]");
          if (root) {
            const tippyReference = root._tippy;
            if (tippyReference) {
              tippyReference.hide();
            }
          }
          break;
        }
      case "ArrowRight":
        {
          const tippyRef = selectedItem._tippy;
          if (!tippyRef) {
            break;
          }
          tippyRef.show();
          tippyRef.props.content.querySelector(".jenkins-dropdown__item").classList.add(SELECTED_ITEM_CLASS);
          break;
        }
    }
  }, container => {
    const isVisible = window.getComputedStyle(container).visibility === "visible";
    const isLastDropdown = Array.from(document.querySelectorAll(".jenkins-dropdown")).filter(dropdown => container !== dropdown).filter(dropdown => window.getComputedStyle(dropdown).visibility === "visible").every(dropdown => !(container.compareDocumentPosition(dropdown) & Node.DOCUMENT_POSITION_FOLLOWING));
    return isVisible && isLastDropdown;
  });
  behavior_shim.applySubtree(menuItems);
  return menuItems;
}
/* harmony default export */ var utils = ({
  generateDropdown,
  generateDropdownItems
});
;// CONCATENATED MODULE: ./src/main/js/components/dropdowns/jumplists.js



function init() {
  generateJumplistAccessors();
  generateDropdowns();
}

/*
 * Appends a ⌄ button at the end of links which support jump lists
 */
function generateJumplistAccessors() {
  behavior_shim.specify("A.model-link", "-jumplist-", 999, link => {
    const isFirefox = navigator.userAgent.indexOf("Firefox") !== -1;
    // Firefox adds unwanted lines when copying buttons in text, so use a span instead
    const dropdownChevron = document.createElement(isFirefox ? "span" : "button");
    dropdownChevron.className = "jenkins-menu-dropdown-chevron";
    dropdownChevron.dataset.href = link.href;
    dropdownChevron.addEventListener("click", event => {
      event.preventDefault();
    });
    link.appendChild(dropdownChevron);
  });
}

/*
 * Generates the dropdowns for the jump lists
 */
function generateDropdowns() {
  behavior_shim.specify("li.children, #menuSelector, .jenkins-menu-dropdown-chevron", "-dropdown-", 1000, element => utils.generateDropdown(element, instance => {
    const href = element.dataset.href;
    const jumplistType = !element.classList.contains("children") ? "contextMenu" : "childrenContextMenu";
    if (element.items) {
      instance.setContent(utils.generateDropdownItems(element.items));
      return;
    }
    fetch(path.combinePath(href, jumplistType)).then(response => response.json()).then(json => instance.setContent(utils.generateDropdownItems(mapChildrenItemsToDropdownItems(json.items)))).catch(error => console.log(`Jumplist request failed: ${error}`)).finally(() => instance.loaded = true);
  }));
}

/*
 * Generates the contents for the dropdown
 */
function mapChildrenItemsToDropdownItems(items) {
  return items.map(item => {
    if (item.type === "HEADER") {
      return {
        type: "HEADER",
        label: item.displayName
      };
    }
    if (item.type === "SEPARATOR") {
      return {
        type: "SEPARATOR"
      };
    }
    return {
      icon: item.icon,
      iconXml: item.iconXml,
      label: item.displayName,
      url: item.url,
      type: item.post || item.requiresConfirmation ? "button" : "link",
      badge: item.badge,
      onClick: () => {
        if (item.post || item.requiresConfirmation) {
          if (item.requiresConfirmation) {
            dialog.confirm(item.displayName, {
              message: item.message
            }).then(() => {
              const form = document.createElement("form");
              form.setAttribute("method", item.post ? "POST" : "GET");
              form.setAttribute("action", item.url);
              if (item.post) {
                crumb.appendToForm(form);
              }
              document.body.appendChild(form);
              form.submit();
            });
          } else {
            fetch(item.url, {
              method: "post",
              headers: crumb.wrap({})
            });
            notificationBar.show(item.displayName + ": Done.", notificationBar.SUCCESS);
          }
        }
      },
      subMenu: item.subMenu ? () => {
        return mapChildrenItemsToDropdownItems(item.subMenu.items);
      } : null
    };
  });
}
/* harmony default export */ var jumplists = ({
  init
});
;// CONCATENATED MODULE: ./src/main/js/components/dropdowns/inpage-jumplist.js


/*
 * Generates a jump list for the active breadcrumb to jump to
 * sections on the page (if using <f:breadcrumb-config-outline />)
 */
function inpage_jumplist_init() {
  const inpageNavigationBreadcrumb = document.querySelector("#inpage-nav");
  if (inpageNavigationBreadcrumb) {
    const chevron = document.createElement("li");
    chevron.classList.add("children");
    chevron.items = Array.from(document.querySelectorAll("form > div > .jenkins-section > .jenkins-section__title")).map(section => {
      section.id = toId(section.textContent);
      return {
        label: section.textContent,
        url: "#" + section.id
      };
    });
    inpageNavigationBreadcrumb.after(chevron);
  }
}
/* harmony default export */ var inpage_jumplist = ({
  init: inpage_jumplist_init
});
;// CONCATENATED MODULE: ./src/main/js/components/dropdowns/overflow-button.js



/**
 * Creates a new dropdown based on the element's next sibling
 */
function overflow_button_init() {
  behavior_shim.specify("[data-dropdown='true']", "-dropdown-", 1000, element => {
    utils.generateDropdown(element, instance => {
      instance.setContent(element.nextElementSibling.content);
    });
  });
}
/* harmony default export */ var overflow_button = ({
  init: overflow_button_init
});
;// CONCATENATED MODULE: ./src/main/js/util/symbols.js
const INFO = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 56C145.72 56 56 145.72 56 256s89.72 200 200 200 200-89.72 200-200S366.28 56 256 56zm0 82a26 26 0 11-26 26 26 26 0 0126-26zm48 226h-88a16 16 0 010-32h28v-88h-16a16 16 0 010-32h32a16 16 0 0116 16v104h28a16 16 0 010 32z" fill='currentColor' /></svg>`;
const SUCCESS = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 48C141.31 48 48 141.31 48 256s93.31 208 208 208 208-93.31 208-208S370.69 48 256 48zm108.25 138.29l-134.4 160a16 16 0 01-12 5.71h-.27a16 16 0 01-11.89-5.3l-57.6-64a16 16 0 1123.78-21.4l45.29 50.32 122.59-145.91a16 16 0 0124.5 20.58z" fill='currentColor'/></svg>`;
const WARNING = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M449.07 399.08L278.64 82.58c-12.08-22.44-44.26-22.44-56.35 0L51.87 399.08A32 32 0 0080 446.25h340.89a32 32 0 0028.18-47.17zm-198.6-1.83a20 20 0 1120-20 20 20 0 01-20 20zm21.72-201.15l-5.74 122a16 16 0 01-32 0l-5.74-121.95a21.73 21.73 0 0121.5-22.69h.21a21.74 21.74 0 0121.73 22.7z" fill='currentColor'/></svg>`;
const ERROR = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 48C141.31 48 48 141.31 48 256s93.31 208 208 208 208-93.31 208-208S370.69 48 256 48zm0 319.91a20 20 0 1120-20 20 20 0 01-20 20zm21.72-201.15l-5.74 122a16 16 0 01-32 0l-5.74-121.94v-.05a21.74 21.74 0 1143.44 0z" fill='currentColor'/></svg>`;
const CLOSE = `<svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"/></svg>`;
const CHEVRON_DOWN = `<svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Chevron Down</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 184l144 144 144-144"/></svg>`;
const FUNNEL = `<svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M35.4 87.12l168.65 196.44A16.07 16.07 0 01208 294v119.32a7.93 7.93 0 005.39 7.59l80.15 26.67A7.94 7.94 0 00304 440V294a16.07 16.07 0 014-10.44L476.6 87.12A14 14 0 00466 64H46.05A14 14 0 0035.4 87.12z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>`;
;// CONCATENATED MODULE: ./src/main/js/components/dropdowns/hetero-list.js






function hetero_list_init() {
  generateButtons();
  generateHandles();
}
function generateHandles() {
  behavior_shim.specify("DIV.dd-handle", "hetero-list", -100, function (e) {
    e.addEventListener("mouseover", function () {
      this.closest(".repeated-chunk").classList.add("hover");
    });
    e.addEventListener("mouseout", function () {
      this.closest(".repeated-chunk").classList.remove("hover");
    });
  });
}
function convertInputsToButtons(e) {
  let oldInputs = e.querySelectorAll("INPUT.hetero-list-add");
  oldInputs.forEach(oldbtn => {
    let btn = document.createElement("button");
    btn.setAttribute("type", "button");
    btn.classList.add("hetero-list-add", "jenkins-button");
    btn.innerText = oldbtn.getAttribute("value");
    if (oldbtn.hasAttribute("suffix")) {
      btn.setAttribute("suffix", oldbtn.getAttribute("suffix"));
    }
    let chevron = createElementFromHtml(CHEVRON_DOWN);
    btn.appendChild(chevron);
    oldbtn.parentNode.appendChild(btn);
    oldbtn.remove();
  });
}
function generateButtons() {
  behavior_shim.specify("DIV.hetero-list-container", "hetero-list-new", -100, function (e) {
    if (isInsideRemovable(e)) {
      return;
    }
    convertInputsToButtons(e);
    let btn = Array.from(e.querySelectorAll("BUTTON.hetero-list-add")).pop();
    let prototypes = e.lastElementChild;
    while (!prototypes.classList.contains("prototypes")) {
      prototypes = prototypes.previousElementSibling;
    }
    let insertionPoint = prototypes.previousElementSibling; // this is where the new item is inserted.

    let templates = [];
    let children = prototypes.children;
    for (let i = 0; i < children.length; i++) {
      let n = children[i];
      let name = n.getAttribute("name");
      let descriptorId = n.getAttribute("descriptorId");
      let title = n.getAttribute("title");
      templates.push({
        html: n.innerHTML,
        name: name,
        descriptorId: descriptorId,
        title: title
      });
    }
    prototypes.remove();
    let withDragDrop = registerSortableDragDrop(e);
    function insert(instance, template) {
      let nc = document.createElement("div");
      nc.className = "repeated-chunk";
      nc.setAttribute("name", template.name);
      nc.setAttribute("descriptorId", template.descriptorId);
      nc.innerHTML = template.html;
      nc.style.opacity = "0";
      instance.hide();
      renderOnDemand(nc.querySelector("div.config-page"), function () {
        function findInsertionPoint() {
          // given the element to be inserted 'prospect',
          // and the array of existing items 'current',
          // and preferred ordering function, return the position in the array
          // the prospect should be inserted.
          // (for example 0 if it should be the first item)
          function findBestPosition(prospect, current, order) {
            function desirability(pos) {
              let count = 0;
              for (let i = 0; i < current.length; i++) {
                if (i < pos == order(current[i]) <= order(prospect)) {
                  count++;
                }
              }
              return count;
            }
            let bestScore = -1;
            let bestPos = 0;
            for (let i = 0; i <= current.length; i++) {
              let d = desirability(i);
              if (bestScore <= d) {
                // prefer to insert them toward the end
                bestScore = d;
                bestPos = i;
              }
            }
            return bestPos;
          }
          let current = Array.from(e.children).filter(function (e) {
            return e.matches("DIV.repeated-chunk");
          });
          function o(did) {
            if (did instanceof Element) {
              did = did.getAttribute("descriptorId");
            }
            for (let i = 0; i < templates.length; i++) {
              if (templates[i].descriptorId == did) {
                return i;
              }
            }
            return 0; // can't happen
          }
          let bestPos = findBestPosition(template.descriptorId, current, o);
          if (bestPos < current.length) {
            return current[bestPos];
          } else {
            return insertionPoint;
          }
        }
        let referenceNode = e.classList.contains("honor-order") ? findInsertionPoint() : insertionPoint;
        referenceNode.parentNode.insertBefore(nc, referenceNode);

        // Initialize drag & drop for this component
        if (withDragDrop) {
          registerSortableDragDrop(nc);
        }
        new YAHOO.util.Anim(nc, {
          opacity: {
            to: 1
          }
        }, 0.2, YAHOO.util.Easing.easeIn).animate();
        Behaviour.applySubtree(nc, true);
        ensureVisible(nc);
        layoutUpdateCallback.call();
      }, true);
    }
    function has(id) {
      return e.querySelector('DIV.repeated-chunk[descriptorId="' + id + '"]') != null;
    }
    let oneEach = e.classList.contains("one-each");
    generateDropDown(btn, instance => {
      let menuItems = [];
      for (let i = 0; i < templates.length; i++) {
        let n = templates[i];
        let disabled = oneEach && has(n.descriptorId);
        let type = disabled ? "DISABLED" : "button";
        let item = {
          label: n.title,
          onClick: event => {
            event.preventDefault();
            event.stopPropagation();
            insert(instance, n);
          },
          type: type
        };
        menuItems.push(item);
      }
      const menuContainer = document.createElement("div");
      const menu = utils.generateDropdownItems(menuItems, true);
      menuContainer.appendChild(createFilter(menu));
      menuContainer.appendChild(menu);
      instance.setContent(menuContainer);
    });
  });
}
function createFilter(menu) {
  const filterInput = createElementFromHtml(`
    <input class="jenkins-dropdown__filter-input" placeholder="Filter" spellcheck="false" type="search"/>
  `);
  filterInput.addEventListener("input", event => applyFilterKeyword(menu, event.currentTarget));
  filterInput.addEventListener("click", event => event.stopPropagation());
  filterInput.addEventListener("keydown", event => {
    if (event.key === "Enter") {
      event.preventDefault();
    }
  });
  const filterContainer = createElementFromHtml(`
    <div class="jenkins-dropdown__filter">
      <div class="jenkins-dropdown__item__icon">
        ${FUNNEL}
      </div>
    </div>
  `);
  filterContainer.appendChild(filterInput);
  return filterContainer;
}
function applyFilterKeyword(menu, filterInput) {
  const filterKeyword = (filterInput.value || "").toLowerCase();
  let items = menu.querySelectorAll(".jenkins-dropdown__item, .jenkins-dropdown__disabled");
  for (let item of items) {
    let match = item.innerText.toLowerCase().includes(filterKeyword);
    item.style.display = match ? "inline-flex" : "none";
  }
}
function generateDropDown(button, callback) {
  (0,tippy_esm/* default */.ZP)(button, Object.assign({}, templates.dropdown(), {
    appendTo: undefined,
    onCreate(instance) {
      if (instance.loaded) {
        return;
      }
      instance.popper.addEventListener("click", () => {
        instance.hide();
      });
      instance.popper.addEventListener("keydown", () => {
        if (event.key === "Escape") {
          instance.hide();
        }
      });
    },
    onShow(instance) {
      callback(instance);
      button.dataset.expanded = "true";
    },
    onHide() {
      button.dataset.expanded = "false";
    }
  }));
}
/* harmony default export */ var hetero_list = ({
  init: hetero_list_init
});
;// CONCATENATED MODULE: ./src/main/js/components/dropdowns/index.js




function dropdowns_init() {
  jumplists.init();
  inpage_jumplist.init();
  overflow_button.init();
  hetero_list.init();
}
/* harmony default export */ var dropdowns = ({
  init: dropdowns_init
});
;// CONCATENATED MODULE: ./src/main/js/components/notifications/index.js


function notifications_init() {
  window.notificationBar = {
    OPACITY: 1,
    DELAY: 3000,
    // milliseconds to auto-close the notification
    div: null,
    // the main 'notification-bar' DIV
    token: null,
    // timer for cancelling auto-close
    defaultIcon: INFO,
    defaultAlertClass: "jenkins-notification",
    SUCCESS: {
      alertClass: "jenkins-notification jenkins-notification--success",
      icon: SUCCESS
    },
    WARNING: {
      alertClass: "jenkins-notification jenkins-notification--warning",
      icon: WARNING
    },
    ERROR: {
      alertClass: "jenkins-notification jenkins-notification--error",
      icon: ERROR,
      sticky: true
    },
    init: function () {
      if (this.div == null) {
        this.div = document.createElement("div");
        this.div.id = "notification-bar";
        document.body.insertBefore(this.div, document.body.firstElementChild);
        const self = this;
        this.div.onclick = function () {
          self.hide();
        };
      } else {
        this.div.innerHTML = "";
      }
    },
    // cancel pending auto-hide timeout
    clearTimeout: function () {
      if (this.token) {
        window.clearTimeout(this.token);
      }
      this.token = null;
    },
    // hide the current notification bar, if it's displayed
    hide: function () {
      this.clearTimeout();
      this.div.classList.remove("jenkins-notification--visible");
      this.div.classList.add("jenkins-notification--hidden");
    },
    // show a notification bar
    show: function (text, options) {
      options = options || {};
      this.init();
      this.div.appendChild(createElementFromHtml(options.icon || this.defaultIcon));
      const message = this.div.appendChild(document.createElement("span"));
      message.appendChild(document.createTextNode(text));
      this.div.className = options.alertClass || this.defaultAlertClass;
      this.div.classList.add("jenkins-notification--visible");
      this.clearTimeout();
      const self = this;
      if (!options.sticky) {
        this.token = window.setTimeout(function () {
          self.hide();
        }, this.DELAY);
      }
    }
  };
}
/* harmony default export */ var notifications = ({
  init: notifications_init
});
;// CONCATENATED MODULE: ./src/main/js/components/search-bar/index.js



const SELECTED_CLASS = "jenkins-search__results-item--selected";
function search_bar_init() {
  const searchBarInputs = document.querySelectorAll(".jenkins-search__input");
  Array.from(searchBarInputs).filter(searchBar => searchBar.suggestions).forEach(searchBar => {
    const searchWrapper = searchBar.parentElement.parentElement;
    const searchResultsContainer = createElementFromHtml(`<div class="jenkins-search__results-container"></div>`);
    searchWrapper.appendChild(searchResultsContainer);
    const searchResults = createElementFromHtml(`<div class="jenkins-search__results"></div>`);
    searchResultsContainer.appendChild(searchResults);
    searchBar.addEventListener("input", () => {
      const query = searchBar.value.toLowerCase();

      // Hide the suggestions if the search query is empty
      if (query.length === 0) {
        hideResultsContainer();
        return;
      }
      showResultsContainer();
      function appendResults(container, results) {
        results.forEach((item, index) => {
          container.appendChild(createElementFromHtml(`<a class="${index === 0 ? SELECTED_CLASS : ""}" href="${item.url}"><div>${item.icon}</div>${xmlEscape(item.label)}</a>`));
        });
        if (results.length === 0 && container === searchResults) {
          container.appendChild(createElementFromHtml(`<p class="jenkins-search__results__no-results-label">No results</p>`));
        }
      }

      // Filter results
      const results = searchBar.suggestions().filter(item => item.label.toLowerCase().includes(query)).slice(0, 5);
      searchResults.innerHTML = "";
      appendResults(searchResults, results);
      searchResultsContainer.style.height = searchResults.offsetHeight + "px";
    });
    function showResultsContainer() {
      searchResultsContainer.classList.add("jenkins-search__results-container--visible");
    }
    function hideResultsContainer() {
      searchResultsContainer.classList.remove("jenkins-search__results-container--visible");
      searchResultsContainer.style.height = "1px";
    }
    searchBar.addEventListener("keydown", e => {
      if (e.key === "ArrowUp" || e.key === "ArrowDown") {
        e.preventDefault();
      }
    });
    makeKeyboardNavigable(searchResultsContainer, () => searchResults.querySelectorAll("a"), SELECTED_CLASS);

    // Workaround: Firefox doesn't update the dropdown height correctly so
    // let's bind the container's height to it's child
    // Disabled in HtmlUnit
    if (!window.isRunAsTest) {
      new ResizeObserver(() => {
        searchResultsContainer.style.height = searchResults.offsetHeight + "px";
      }).observe(searchResults);
    }
    searchBar.addEventListener("focusin", () => {
      if (searchBar.value.length !== 0) {
        searchResultsContainer.style.height = searchResults.offsetHeight + "px";
        showResultsContainer();
      }
    });
    document.addEventListener("click", event => {
      if (searchWrapper.contains(event.target)) {
        return;
      }
      hideResultsContainer();
    });
  });
}
/* harmony default export */ var search_bar = ({
  init: search_bar_init
});
;// CONCATENATED MODULE: ./src/main/js/components/tooltips/index.js


const TOOLTIP_BASE = {
  arrow: false,
  theme: "tooltip",
  animation: "tooltip",
  appendTo: document.body
};

/**
 * Registers tooltips for the given element
 * If called again, destroys any existing tooltip for the element and
 * registers them again (useful for progressive rendering)
 * @param {HTMLElement} element - Registers the tooltips for the given element
 */
function registerTooltip(element) {
  if (element._tippy && element._tippy.props.theme === "tooltip") {
    element._tippy.destroy();
  }
  const tooltip = element.getAttribute("tooltip");
  const htmlTooltip = element.getAttribute("data-html-tooltip");
  if (tooltip !== null && tooltip.trim().length > 0 && (htmlTooltip === null || htmlTooltip.trim().length == 0)) {
    (0,tippy_esm/* default */.ZP)(element, Object.assign({
      content: () => tooltip.replace(/<br[ /]?\/?>|\\n/g, "\n"),
      onCreate(instance) {
        instance.reference.setAttribute("title", instance.props.content);
      },
      onShow(instance) {
        instance.reference.removeAttribute("title");
      },
      onHidden(instance) {
        instance.reference.setAttribute("title", instance.props.content);
      }
    }, TOOLTIP_BASE));
  }
  if (htmlTooltip !== null && htmlTooltip.trim().length > 0) {
    (0,tippy_esm/* default */.ZP)(element, Object.assign({
      content: () => htmlTooltip,
      allowHTML: true,
      onCreate(instance) {
        instance.props.interactive = instance.reference.getAttribute("data-tooltip-interactive") === "true";
      }
    }, TOOLTIP_BASE));
  }
}

/**
 * Displays a tooltip for three seconds on the provided element after interaction
 * @param {string} text - The tooltip text
 * @param {HTMLElement} element - The element to show the tooltip
 */
function hoverNotification(text, element) {
  const tooltip = (0,tippy_esm/* default */.ZP)(element, Object.assign({
    trigger: "hover",
    offset: [0, 0],
    content: text,
    onShow(instance) {
      setTimeout(() => {
        instance.hide();
      }, 3000);
    }
  }, TOOLTIP_BASE));
  tooltip.show();
}
function tooltips_init() {
  behavior_shim.specify("[tooltip], [data-html-tooltip]", "-tooltip-", 1000, element => {
    registerTooltip(element);
  });
  window.hoverNotification = hoverNotification;
}
/* harmony default export */ var tooltips = ({
  init: tooltips_init
});
;// CONCATENATED MODULE: ./src/main/js/components/stop-button-link/index.js

function registerStopButton(link) {
  let question = link.getAttribute("data-confirm");
  let url = link.getAttribute("href");
  link.addEventListener("click", function (e) {
    e.preventDefault();
    var execute = function () {
      fetch(url, {
        method: "post",
        headers: crumb.wrap({})
      });
    };
    if (question != null) {
      dialog.confirm(question).then(() => {
        execute();
      });
    } else {
      execute();
    }
  });
}
function stop_button_link_init() {
  behavior_shim.specify(".stop-button-link", "stop-button-link", 0, element => {
    registerStopButton(element);
  });
}
/* harmony default export */ var stop_button_link = ({
  init: stop_button_link_init
});
;// CONCATENATED MODULE: ./src/main/js/components/confirmation-link/index.js

function registerConfirmationLink(element) {
  const post = element.getAttribute("data-post") === "true";
  const href = element.getAttribute("data-url");
  const message = element.getAttribute("data-message");
  const title = element.getAttribute("data-title");
  const destructive = element.getAttribute("data-destructive");
  let type = "default";
  if (destructive === "true") {
    type = "destructive";
  }
  element.addEventListener("click", function (e) {
    e.preventDefault();
    dialog.confirm(title, {
      message: message,
      type: type
    }).then(() => {
      var form = document.createElement("form");
      form.setAttribute("method", post ? "POST" : "GET");
      form.setAttribute("action", href);
      if (post) {
        crumb.appendToForm(form);
      }
      document.body.appendChild(form);
      form.submit();
    }, () => {});
    return false;
  });
}
function confirmation_link_init() {
  behavior_shim.specify("A.confirmation-link", "confirmation-link", 0, element => {
    registerConfirmationLink(element);
  });
}
/* harmony default export */ var confirmation_link = ({
  init: confirmation_link_init
});
// EXTERNAL MODULE: ../../../../../.yarn/berry/cache/jquery-npm-3.7.1-eeeac0f21e-10c0.zip/node_modules/jquery/dist/jquery.js
var jquery = __webpack_require__(6284);
var jquery_default = /*#__PURE__*/__webpack_require__.n(jquery);
// EXTERNAL MODULE: ../../../../../.yarn/berry/cache/window-handle-npm-1.0.1-369b8e9cbe-10c0.zip/node_modules/window-handle/index.js
var window_handle = __webpack_require__(6569);
// EXTERNAL MODULE: ../../../../../.yarn/berry/cache/handlebars-npm-4.7.8-25244c2c82-10c0.zip/node_modules/handlebars/runtime.js
var runtime = __webpack_require__(7218);
var runtime_default = /*#__PURE__*/__webpack_require__.n(runtime);
;// CONCATENATED MODULE: ./src/main/js/util/jenkins.js
/**
 * Jenkins JS Modules common utility functions
 */



var debug = false;
var jenkins = {};

// gets the base Jenkins URL including context path
jenkins.baseUrl = function () {
  var u = jquery_default()("head").attr("data-rooturl");
  if (!u) {
    u = "";
  }
  return u;
};

/**
 * redirect
 */
jenkins.goTo = function (url) {
  window_handle.getWindow().location.replace(jenkins.baseUrl() + url);
};

/**
 * Jenkins AJAX GET callback.
 * If last parameter is an object, will be extended to jQuery options (e.g. pass { error: function() ... } to handle errors)
 */
jenkins.get = function (url, success, options) {
  if (debug) {
    console.log("get: " + url);
  }
  var args = {
    url: jenkins.baseUrl() + url,
    type: "GET",
    cache: false,
    dataType: "json",
    success: success
  };
  if (options instanceof Object) {
    jquery_default().extend(args, options);
  }
  jquery_default().ajax(args);
};

/**
 * Jenkins AJAX POST callback, formats data as a JSON object post
 * If last parameter is an object, will be extended to jQuery options (e.g. pass { error: function() ... } to handle errors)
 */
jenkins.post = function (url, data, success, options) {
  if (debug) {
    console.log("post: " + url);
  }

  // handle crumbs
  var headers = {};
  var wnd = window_handle.getWindow();
  var crumb;
  if ("crumb" in options) {
    crumb = options.crumb;
  } else if ("crumb" in wnd) {
    crumb = wnd.crumb;
  }
  if (crumb) {
    headers[crumb.fieldName] = crumb.value;
  }
  var formBody = data;
  if (formBody instanceof Object) {
    if (crumb) {
      formBody = jquery_default().extend({}, formBody);
      formBody[crumb.fieldName] = crumb.value;
    }
    formBody = JSON.stringify(formBody);
  }
  var args = {
    url: jenkins.baseUrl() + url,
    type: "POST",
    cache: false,
    dataType: "json",
    data: formBody,
    contentType: "application/json",
    success: success,
    headers: headers
  };
  if (options instanceof Object) {
    jquery_default().extend(args, options);
  }
  jquery_default().ajax(args);
};

/**
 *  handlebars setup, done for backwards compatibility because some plugins depend on it
 */
jenkins.initHandlebars = function () {
  return (runtime_default());
};

/**
 * Load translations for the given bundle ID, provide the message object to the handler.
 * Optional error handler as the last argument.
 */
jenkins.loadTranslations = function (bundleName, handler, onError) {
  jenkins.get("/i18n/resourceBundle?baseName=" + bundleName, function (res) {
    if (res.status !== "ok") {
      if (onError) {
        onError(res.message);
      }
      throw "Unable to load localization data: " + res.message;
    }
    var translations = res.data;
    if ("undefined" !== typeof Proxy) {
      translations = new Proxy(translations, {
        get: function (target, property) {
          if (property in target) {
            return target[property];
          }
          if (debug) {
            console.log('"' + property + '" not found in translation bundle.');
          }
          return property;
        }
      });
    }
    handler(translations);
  });
};

/**
 * Runs a connectivity test, calls handler with a boolean whether there is sufficient connectivity to the internet
 */
jenkins.testConnectivity = function (siteId, handler) {
  // check the connectivity api
  var testConnectivity = function () {
    jenkins.get("/updateCenter/connectionStatus?siteId=" + siteId, function (response) {
      if (response.status !== "ok") {
        handler(false, true, response.message);
      }

      // Define statuses, which need additional check iteration via async job on the Jenkins master
      // Statuses like "OK" or "SKIPPED" are considered as fine.
      var uncheckedStatuses = ["PRECHECK", "CHECKING", "UNCHECKED"];
      if (uncheckedStatuses.indexOf(response.data.updatesite) >= 0 || uncheckedStatuses.indexOf(response.data.internet) >= 0) {
        setTimeout(testConnectivity, 100);
      } else {
        // Update site should be always reachable, but we do not require the internet connection
        // if it's explicitly skipped by the update center
        if (response.status !== "ok" || response.data.updatesite !== "OK" || response.data.internet !== "OK" && response.data.internet !== "SKIPPED") {
          // no connectivity, but not fatal
          handler(false, false);
        } else {
          handler(true);
        }
      }
    }, {
      error: function (xhr, textStatus, errorThrown) {
        if (xhr.status === 403) {
          jenkins.goTo("/login");
        } else {
          handler.call({
            isError: true,
            errorMessage: errorThrown
          });
        }
      }
    });
  };
  testConnectivity();
};

/**
 * gets the window containing a form, taking in to account top-level iframes
 */
jenkins.getWindow = function ($form) {
  $form = jquery_default()($form);
  var wnd = window_handle.getWindow();
  jquery_default()(top.document).find("iframe").each(function () {
    var windowFrame = this.contentWindow;
    var $f = jquery_default()(this).contents().find("form");
    $f.each(function () {
      if ($form[0] === this) {
        wnd = windowFrame;
      }
    });
  });
  return wnd;
};

/**
 * Builds a stapler form post
 */
jenkins.buildFormPost = function ($form) {
  $form = jquery_default()($form);
  var wnd = jenkins.getWindow($form);
  var form = $form[0];
  if (wnd.buildFormTree(form)) {
    return $form.serialize() + "&" + jquery_default().param({
      "core:apply": "",
      Submit: "Save",
      json: $form.find("input[name=json]").val()
    });
  }
  return "";
};

/**
 * Gets the crumb, if crumbs are enabled
 */
jenkins.getFormCrumb = function ($form) {
  $form = jquery_default()($form);
  var wnd = jenkins.getWindow($form);
  return wnd.crumb;
};

/**
 * Jenkins Stapler JSON POST callback
 * If last parameter is an object, will be extended to jQuery options (e.g. pass { error: function() ... } to handle errors)
 */
jenkins.staplerPost = function (url, $form, success, options) {
  $form = jquery_default()($form);
  var postBody = jenkins.buildFormPost($form);
  var crumb = jenkins.getFormCrumb($form);
  jenkins.post(url, postBody, success, jquery_default().extend({
    processData: false,
    contentType: "application/x-www-form-urlencoded",
    crumb: crumb
  }, options));
};
/* harmony default export */ var util_jenkins = (jenkins);
;// CONCATENATED MODULE: ./src/main/js/components/dialogs/index.js




let _defaults = {
  title: null,
  message: null,
  cancel: true,
  maxWidth: "475px",
  minWidth: "450px",
  type: "default",
  hideCloseButton: false,
  allowEmpty: false,
  submitButton: false
};
let _typeClassMap = {
  default: "",
  destructive: "jenkins-!-destructive-color"
};
util_jenkins.loadTranslations("jenkins.dialogs", function (localizations) {
  window.dialog.translations = localizations;
  _defaults.cancelText = localizations.cancel;
  _defaults.okText = localizations.ok;
});
function Dialog(dialogType, options) {
  this.dialogType = dialogType;
  this.options = Object.assign({}, _defaults, options);
  this.init();
}
Dialog.prototype.init = function () {
  this.dialog = document.createElement("dialog");
  this.dialog.classList.add("jenkins-dialog");
  this.dialog.style.maxWidth = this.options.maxWidth;
  this.dialog.style.minWidth = this.options.minWidth;
  document.body.appendChild(this.dialog);
  if (this.options.title != null) {
    const title = createElementFromHtml(`<div class='jenkins-dialog__title'/>`);
    this.dialog.appendChild(title);
    title.innerText = this.options.title;
  }
  if (this.dialogType === "modal") {
    if (this.options.content != null) {
      const content = createElementFromHtml(`<div class='jenkins-dialog__contents jenkins-dialog__contents--modal'/>`);
      content.appendChild(this.options.content);
      this.dialog.appendChild(content);
    }
    if (this.options.hideCloseButton !== true) {
      const closeButton = createElementFromHtml(`
          <button class="jenkins-dialog__close-button jenkins-button">
            <span class="jenkins-visually-hidden">Close</span>
            ${CLOSE}
          </button>
        `);
      this.dialog.appendChild(closeButton);
      closeButton.addEventListener("click", () => this.dialog.dispatchEvent(new Event("cancel")));
    }
    this.dialog.addEventListener("click", function (e) {
      if (e.target !== e.currentTarget) {
        return;
      }
      this.dispatchEvent(new Event("cancel"));
    });
    this.ok = null;
  } else {
    this.form = null;
    if (this.options.form != null && this.dialogType === "form") {
      const contents = createElementFromHtml(`<div class='jenkins-dialog__contents'/>`);
      this.form = this.options.form;
      contents.appendChild(this.options.form);
      this.dialog.appendChild(contents);
      behavior_shim.applySubtree(contents, true);
    }
    if (this.options.message != null && this.dialogType !== "form") {
      const message = createElementFromHtml(`<div class='jenkins-dialog__contents'/>`);
      this.dialog.appendChild(message);
      message.innerText = this.options.message;
    }
    if (this.dialogType === "prompt") {
      let inputDiv = createElementFromHtml(`<div class="jenkins-dialog__input">
          <input data-id="input" type="text" class='jenkins-input'></div>`);
      this.dialog.appendChild(inputDiv);
      this.input = inputDiv.querySelector("[data-id=input]");
      if (!this.options.allowEmpty) {
        this.input.addEventListener("input", () => this.checkInput());
      }
    }
    this.appendButtons();
    this.dialog.addEventListener("keydown", e => {
      if (e.key === "Enter") {
        e.preventDefault();
        if (this.ok.disabled == false) {
          this.ok.dispatchEvent(new Event("click"));
        }
      }
      if (e.key === "Escape") {
        e.preventDefault();
        this.dialog.dispatchEvent(new Event("cancel"));
      }
    });
  }
};
Dialog.prototype.checkInput = function () {
  if (this.input.value.trim()) {
    this.ok.disabled = false;
  } else {
    this.ok.disabled = true;
  }
};
Dialog.prototype.appendButtons = function () {
  const buttons = createElementFromHtml(`<div
      class="jenkins-buttons-row jenkins-buttons-row--equal-width jenkins-dialog__buttons">
      <button data-id="ok" type="${this.options.submitButton ? "submit" : "button"}" class="jenkins-button jenkins-button--primary ${_typeClassMap[this.options.type]}">${this.options.okText}</button>
      <button data-id="cancel" class="jenkins-button">${this.options.cancelText}</button>
    </div>`);
  if (this.dialogType === "form") {
    this.form.appendChild(buttons);
  } else {
    this.dialog.appendChild(buttons);
  }
  this.ok = buttons.querySelector("[data-id=ok]");
  this.cancel = buttons.querySelector("[data-id=cancel]");
  if (!this.options.cancel) {
    this.cancel.style.display = "none";
  } else {
    this.cancel.addEventListener("click", e => {
      e.preventDefault();
      this.dialog.dispatchEvent(new Event("cancel"));
    });
  }
  if (this.dialogType === "prompt" && !this.options.allowEmpty) {
    this.ok.disabled = true;
  }
};
Dialog.prototype.show = function () {
  return new Promise((resolve, cancel) => {
    this.dialog.showModal();
    this.dialog.addEventListener("cancel", e => {
      e.preventDefault();
      this.dialog.remove();
      cancel();
    }, {
      once: true
    });
    this.dialog.focus();
    if (this.input != null) {
      this.input.focus();
    }
    if (this.ok != null && (this.dialogType != "form" || !this.options.submitButton)) {
      this.ok.addEventListener("click", e => {
        e.preventDefault();
        let value = true;
        if (this.dialogType === "prompt") {
          value = this.input.value;
        }
        if (this.dialogType === "form") {
          value = new FormData(this.form);
        }
        this.dialog.remove();
        resolve(value);
      }, {
        once: true
      });
    }
  });
};
function dialogs_init() {
  window.dialog = {
    modal: function (content, options) {
      const defaults = {
        content: content
      };
      options = Object.assign({}, defaults, options);
      let dialog = new Dialog("modal", options);
      dialog.show().then().catch(() => {});
    },
    alert: function (title, options) {
      const defaults = {
        title: title,
        cancel: false
      };
      options = Object.assign({}, defaults, options);
      let dialog = new Dialog("alert", options);
      dialog.show().then().catch(() => {});
    },
    confirm: function (title, options) {
      const defaults = {
        title: title,
        okText: window.dialog.translations.yes
      };
      options = Object.assign({}, defaults, options);
      let dialog = new Dialog("confirm", options);
      return dialog.show();
    },
    prompt: function (title, options) {
      const defaults = {
        title: title
      };
      options = Object.assign({}, defaults, options);
      let dialog = new Dialog("prompt", options);
      return dialog.show();
    },
    form: function (form, options) {
      const defaults = {
        form: form,
        minWidth: "600px",
        maxWidth: "900px",
        submitButton: true,
        okText: window.dialog.translations.submit
      };
      options = Object.assign({}, defaults, options);
      let dialog = new Dialog("form", options);
      return dialog.show();
    }
  };
}
/* harmony default export */ var dialogs = ({
  init: dialogs_init
});
;// CONCATENATED MODULE: ./src/main/js/app.js







dropdowns.init();
notifications.init();
search_bar.init();
tooltips.init();
stop_button_link.init();
confirmation_link.init();
dialogs.init();

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	!function() {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = function(result, chunkIds, fn, priority) {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var chunkIds = deferred[i][0];
/******/ 				var fn = deferred[i][1];
/******/ 				var priority = deferred[i][2];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every(function(key) { return __webpack_require__.O[key](chunkIds[j]); })) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	!function() {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/runtimeId */
/******/ 	!function() {
/******/ 		__webpack_require__.j = 143;
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	!function() {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			143: 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = function(chunkId) { return installedChunks[chunkId] === 0; };
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = function(parentChunkLoadingFunction, data) {
/******/ 			var chunkIds = data[0];
/******/ 			var moreModules = data[1];
/******/ 			var runtime = data[2];
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some(function(id) { return installedChunks[id] !== 0; })) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkjenkins_ui"] = self["webpackChunkjenkins_ui"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/nonce */
/******/ 	!function() {
/******/ 		__webpack_require__.nc = undefined;
/******/ 	}();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, [216], function() { return __webpack_require__(237); })
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=app.js.map