<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>IT Tab — Admin Dashboard (Full)</title>
  <style>
    :root{--blue:#0A2A5A;--yellow:#FFC300;--muted:#f4f7fb}
    *{box-sizing:border-box}
    body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,'Helvetica Neue',Arial;background:linear-gradient(180deg,#071334 0%, #0b2346 100%);color:#222}
    .app{max-width:1200px;margin:20px auto;background:#fff;border-radius:10px;overflow:hidden;display:grid;grid-template-columns:260px 1fr;min-height:720px;box-shadow:0 18px 50px rgba(2,8,23,0.45)}
    .sidebar{background:var(--blue);color:#fff;padding:22px;display:flex;flex-direction:column}
    .brand{display:flex;align-items:center;gap:12px;margin-bottom:18px}
    .logo{width:48px;height:48px;border-radius:8px;background:linear-gradient(135deg,var(--yellow),#f0a700);display:flex;align-items:center;justify-content:center;font-weight:900;color:var(--blue)}
    .brand h1{font-size:18px;margin:0}
    nav{margin-top:12px;flex:1}
    nav button{width:100%;display:flex;align-items:center;gap:10px;padding:10px 12px;border:none;background:transparent;color:inherit;text-align:left;border-radius:6px;margin-bottom:6px;cursor:pointer}
    nav button.active, nav button:hover{background:rgba(255,255,255,0.06)}
    .small{font-size:13px;color:rgba(255,255,255,0.85)}
    .sidebar .helper{margin-top:12px;font-size:13px}
    .logout{margin-top:18px;padding:10px;border-radius:6px;background:#fff;color:var(--blue);border:none;cursor:pointer;width:100%;font-weight:700}
    .main{padding:24px}
    .top{display:flex;justify-content:space-between;align-items:center}
    .top h2{margin:0;color:var(--blue)}
    .card{background:#fbfdff;border-radius:8px;padding:18px;margin-top:18px;box-shadow:0 6px 18px rgba(12,20,40,0.05)}
    .form-row{display:flex;gap:12px}
    label{display:block;font-size:13px;margin-bottom:6px;color:#333}
    input[type=text],textarea,select{width:100%;padding:10px;border:1px solid #d6dcea;border-radius:6px;font-size:14px}
    textarea{min-height:80px;resize:vertical}
    .btn{display:inline-block;padding:10px 14px;border-radius:6px;border:none;background:var(--yellow);color:var(--blue);font-weight:700;cursor:pointer}
    .btn.ghost{background:transparent;border:1px solid #ddd;color:#333}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    .field{margin-bottom:12px}
    .table{width:100%;border-collapse:collapse;margin-top:12px}
    .table th,.table td{padding:8px 10px;border-bottom:1px solid #eef3fb;text-align:left}
    .actions{display:flex;gap:8px}
    .preview{margin-top:18px;padding:18px;background:#fff;border-radius:8px;border:1px solid #eef3fb}
    .overlay{position:fixed;inset:0;background:linear-gradient(180deg,rgba(2,8,23,0.6),rgba(2,8,23,0.85));display:flex;align-items:center;justify-content:center}
    .login{width:460px;background:#fff;padding:26px;border-radius:10px;box-shadow:0 18px 40px rgba(1,8,22,0.6)}
    .login h2{margin:0 0 14px 0;color:var(--blue)}
    .hint{font-size:13px;color:#556}
    .modal{position:fixed;left:50%;top:50%;transform:translate(-50%,-50%);background:#fff;padding:18px;border-radius:8px;box-shadow:0 10px 30px rgba(0,0,0,0.4);z-index:60;min-width:320px}
    .backdrop{position:fixed;inset:0;background:rgba(0,0,0,0.35);z-index:50}
    @media (max-width:1000px){.app{grid-template-columns:1fr}.sidebar{display:flex;flex-direction:row;gap:12px;overflow:auto;padding:12px}.main{padding:16px}}
  </style>
</head>
<body>

<div id="app">
  <!-- Login overlay -->
  <div id="loginOverlay" class="overlay" style="display:none">
    <div class="login">
      <h2>Admin Login</h2>
      
      <div style="margin-top:12px">
        <label>Username</label>
        <input id="loginUser" type="text" placeholder="admin">
      </div>
      <div style="margin-top:10px">
        <label>Password</label>
        <input style="width:100%;
  padding:11px;
  border:1px solid #d6dcea;
  border-radius:6px;
  font-size:14px;" id="loginPass" type="password" placeholder="password">
      </div>
      <div style="margin-top:14px;display:flex;gap:8px;justify-content:flex-end">
        <button id="loginBtn" class="btn">Login</button>
        <button id="demoFill" class="btn ghost">Fill Demo</button>
        <button style=" padding:10px 14px;
  border-radius:6px;
  border:none;
  background:#FFC300;
  color:#0A2A5A;
  font-weight:700;
  cursor:pointer;  background:transparent;
  border:1px solid #ddd;
  color:#333;" onclick="window.location.href='index.php'">HOME</button>
      </div>
      <p id="loginError" style="color:#c33;margin-top:10px;display:none">Invalid credentials</p>
    </div>
  </div>

  <div class="app">
    <aside class="sidebar">
      <div class="brand"><div class="logo">IT</div><div><h1>ITTab Admin</h1><div class="small">Manage content & users</div></div></div>

      <nav>
        <button data-view="dashboard" class="active">Dashboard</button>
        <button data-view="faculty">Faculty Records</button>
        <button data-view="orgs">Organizations</button>
        <button data-view="cms">CMS Content</button>
        <button data-view="posts">Posts</button>
        <button data-view="inbox">Inbox</button>
        <button onclick="window.location.href='view_inquiries.php'">All Inquiries</button>
        <button data-view="admins">Admin Users</button>
        <button data-view="settings">Settings</button>
      </nav>

      <div class="helper">
        <div>Signed in as <strong id="adminName">admin</strong></div>
      </div>

      <button id="logoutBtn" class="logout">Log out</button>
    </aside>

    <main class="main">
      <div class="top">
        <h2 id="pageTitle">Dashboard</h2>
        <div>
          <button id="exportBtn" class="btn">Export Data</button>
          <button id="importBtn" class="btn ghost">Import</button>
        </div>
      </div>

      <div id="editorArea" class="card">
        <!-- view injected here -->
      </div>

      <div id="preview" class="preview">
        <h3>Quick Summary</h3>
        <div id="summary">Loading...</div>
      </div>

    </main>
  </div>
</div>

<!-- modal placeholders -->
<div id="backdrop" class="backdrop" style="display:none"></div>
<div id="modal" class="modal" style="display:none"></div>

<script>
// Single-file admin system (frontend-only) using localStorage to simulate backend
const ADMIN_USER='reyngie01', ADMIN_PASS='Admin123'
const DEFAULT = {
  faculty: [],
  orgs: [],
  posts: [],
  inbox: [],
  admins: [{username:'admin'}],
  content: {hero:{title:'TabIT', subtitle:'Lorem ipsum'}, about:{heading:'ABOUT US', body:'...'}}
}

// helpers
const qs = (s,ctx=document)=>ctx.querySelector(s)
const qsa = (s,ctx=document)=>Array.from(ctx.querySelectorAll(s))
let state = load()
let currentView='dashboard'

function init(){
  hookNav(); hookButtons(); renderView('dashboard'); renderSummary(); checkAuth();
}

function checkAuth(){
  const authed = localStorage.getItem('tabit_admin_authed')==='1'
  qs('#loginOverlay').style.display = authed? 'none':'flex'
}

function hookNav(){
  qsa('nav button', document.querySelector('.sidebar')).forEach(btn=>{
    btn.addEventListener('click', ()=>{
      qsa('nav button', document.querySelector('.sidebar')).forEach(b=>b.classList.remove('active'))
      btn.classList.add('active')
      currentView = btn.dataset.view
      qs('#pageTitle').textContent = btn.textContent.trim()
      renderView(currentView)
    })
  })
}

function hookButtons(){
  qs('#loginBtn').addEventListener('click', attemptLogin)
  qs('#demoFill').addEventListener('click', ()=>{qs('#loginUser').value=ADMIN_USER; qs('#loginPass').value=ADMIN_PASS})
  qs('#logoutBtn').addEventListener('click', ()=>{localStorage.removeItem('tabit_admin_authed'); checkAuth();})
  qs('#exportBtn').addEventListener('click', exportAll)
  qs('#importBtn').addEventListener('click', ()=>{ openFileDialog(handleImport) })
}

function attemptLogin(){
  const u=qs('#loginUser').value.trim(), p=qs('#loginPass').value
  if(u===ADMIN_USER && p===ADMIN_PASS){ localStorage.setItem('tabit_admin_authed','1'); qs('#loginOverlay').style.display='none'; qs('#adminName').textContent = u } else { qs('#loginError').style.display='block' }
}

function load(){
  try{ const raw=localStorage.getItem('tabit_full'); return raw? JSON.parse(raw): JSON.parse(JSON.stringify(DEFAULT)) }catch(e){ return JSON.parse(JSON.stringify(DEFAULT)) }
}
function save(){ localStorage.setItem('tabit_full', JSON.stringify(state)); renderSummary() }

function renderSummary(){ qs('#summary').innerHTML = `Faculty: <strong>${state.faculty.length}</strong> | Orgs: <strong>${state.orgs.length}</strong> | Posts: <strong>${state.posts.length}</strong> | Inbox: <strong>${state.inbox.length}</strong>` }

function renderView(view){ const c = qs('#editorArea'); c.innerHTML=''; if(view==='dashboard') return c.innerHTML = `<h3>Welcome, Admin</h3><p>Use the sidebar to manage records, content, posts, and messages.</p><div style="margin-top:12px"><button class='btn' onclick="showModalAddFaculty()">Add Faculty</button> <button class='btn ghost' onclick="showModalAddOrg()">Add Org</button></div>`

if(view==='faculty') renderFaculty(c)
else if(view==='orgs') renderOrgs(c)
else if(view==='cms') renderCMS(c)
else if(view==='posts') renderPosts(c)
else if(view==='inbox') renderInbox(c)
else if(view==='admins') renderAdmins(c)
else if(view==='settings') renderSettings(c)
}

// --- Faculty CRUD ---
function renderFaculty(container){
  container.innerHTML = `
    <h3>Faculty Records</h3>
    <div style="display:flex;gap:8px;margin-top:12px"><button class="btn" onclick="showModalAddFaculty()">Add Faculty</button><button class="btn ghost" onclick="bulkSeedFaculty()">Seed Sample</button></div>
    <table class="table" id="facultyTable"><thead><tr><th>Name</th><th>Department</th><th>Email</th><th>Actions</th></tr></thead><tbody></tbody></table>
  `
  const tbody = qs('#facultyTable tbody')
  tbody.innerHTML = state.faculty.map((f,idx)=>`<tr><td>${escapeHtml(f.name)}</td><td>${escapeHtml(f.dept)}</td><td>${escapeHtml(f.email)}</td><td class="actions"><button class='btn ghost' onclick='editFaculty(${idx})'>Edit</button><button class='btn' onclick='deleteFaculty(${idx})'>Delete</button></td></tr>`).join('')
}
function showModalAddFaculty(){ showModal(`<h3>Add Faculty</h3><div class='field'><label>Name</label><input id='f_name' type='text'></div><div class='field'><label>Department</label><input id='f_dept' type='text'></div><div class='field'><label>Email</label><input id='f_email' type='text'></div><div style='text-align:right'><button class='btn' id='saveFacultyBtn'>Save</button></div>`) ; qs('#saveFacultyBtn').addEventListener('click', ()=>{ const n=qs('#f_name').value.trim(), d=qs('#f_dept').value.trim(), e=qs('#f_email').value.trim(); if(!n){alert('Name required');return} state.faculty.push({name:n,dept:d,email:e}); save(); closeModal(); renderView('faculty') }) }
function editFaculty(i){ const f = state.faculty[i]; showModal(`<h3>Edit Faculty</h3><div class='field'><label>Name</label><input id='f_name' type='text' value='${escapeHtml(f.name)}'></div><div class='field'><label>Department</label><input id='f_dept' type='text' value='${escapeHtml(f.dept)}'></div><div class='field'><label>Email</label><input id='f_email' type='text' value='${escapeHtml(f.email)}'></div><div style='text-align:right'><button class='btn' id='updateFacultyBtn'>Update</button></div>`)
  qs('#updateFacultyBtn').addEventListener('click', ()=>{ state.faculty[i].name=qs('#f_name').value; state.faculty[i].dept=qs('#f_dept').value; state.faculty[i].email=qs('#f_email').value; save(); closeModal(); renderView('faculty') }) }
function deleteFaculty(i){ if(confirm('Delete this faculty record?')){ state.faculty.splice(i,1); save(); renderView('faculty') } }
function bulkSeedFaculty(){ state.faculty.push({name:'Dr. Maria Cruz',dept:'Computer Science',email:'m.cruz@example.com'},{name:'Mr. John Doe',dept:'IT',email:'j.doe@example.com'}); save(); renderView('faculty') }

// --- Organizations CRUD ---
function renderOrgs(container){ container.innerHTML = `<h3>Organizations</h3><div style='margin-top:12px'><button class='btn' onclick='showModalAddOrg()'>Add Organization</button></div><table class='table'><thead><tr><th>Name</th><th>Contact</th><th>Actions</th></tr></thead><tbody>${state.orgs.map((o,i)=>`<tr><td>${escapeHtml(o.name)}</td><td>${escapeHtml(o.contact)}</td><td class='actions'><button class='btn ghost' onclick='editOrg(${i})'>Edit</button><button class='btn' onclick='deleteOrg(${i})'>Delete</button></td></tr>`).join('')}</tbody></table>` }
function showModalAddOrg(){ showModal(`<h3>Add Organization</h3><div class='field'><label>Name</label><input id='o_name' type='text'></div><div class='field'><label>Contact</label><input id='o_contact' type='text'></div><div style='text-align:right'><button class='btn' id='saveOrgBtn'>Save</button></div>`); qs('#saveOrgBtn').addEventListener('click', ()=>{ const n=qs('#o_name').value.trim(), c=qs('#o_contact').value.trim(); if(!n){alert('Name required');return} state.orgs.push({name:n,contact:c}); save(); closeModal(); renderView('orgs') }) }
function editOrg(i){ const o=state.orgs[i]; showModal(`<h3>Edit Organization</h3><div class='field'><label>Name</label><input id='o_name' type='text' value='${escapeHtml(o.name)}'></div><div class='field'><label>Contact</label><input id='o_contact' type='text' value='${escapeHtml(o.contact)}'></div><div style='text-align:right'><button class='btn' id='updateOrgBtn'>Update</button></div>`); qs('#updateOrgBtn').addEventListener('click', ()=>{ state.orgs[i].name=qs('#o_name').value; state.orgs[i].contact=qs('#o_contact').value; save(); closeModal(); renderView('orgs') }) }
function deleteOrg(i){ if(confirm('Delete this organization?')){ state.orgs.splice(i,1); save(); renderView('orgs') } }

// --- CMS content editor ---
function renderCMS(container){ container.innerHTML = `<h3>CMS Content</h3><div class='row'><div><div class='field'><label>Hero Title</label><input id='c_hero_title' type='text'></div><div class='field'><label>Hero Subtitle</label><input id='c_hero_sub' type='text'></div></div><div><div class='field'><label>About Heading</label><input id='c_about_h' type='text'></div><div class='field'><label>About Body</label><textarea id='c_about_b'></textarea></div></div></div><div style='margin-top:12px'><button class='btn' id='saveCmsBtn'>Save</button></div>`; qs('#c_hero_title').value=state.content.hero.title; qs('#c_hero_sub').value=state.content.hero.subtitle; qs('#c_about_h').value=state.content.about.heading; qs('#c_about_b').value=state.content.about.body; qs('#saveCmsBtn').addEventListener('click', ()=>{ state.content.hero.title=qs('#c_hero_title').value; state.content.hero.subtitle=qs('#c_hero_sub').value; state.content.about.heading=qs('#c_about_h').value; state.content.about.body=qs('#c_about_b').value; save(); alert('Content saved'); renderView('cms') }) }

// --- Posts (posting system) ---
function renderPosts(container){ container.innerHTML = `<h3>Posts</h3><div style='display:flex;gap:8px;margin-top:12px'><button class='btn' onclick='showModalAddPost()'>New Post</button></div><table class='table'><thead><tr><th>Title</th><th>Author</th><th>Date</th><th>Actions</th></tr></thead><tbody>${state.posts.map((p,i)=>`<tr><td>${escapeHtml(p.title)}</td><td>${escapeHtml(p.author)}</td><td>${escapeHtml(p.date)}</td><td class='actions'><button class='btn ghost' onclick='editPost(${i})'>Edit</button><button class='btn' onclick='deletePost(${i})'>Delete</button></td></tr>`).join('')}</tbody></table>` }
function showModalAddPost(){ showModal(`<h3>New Post</h3><div class='field'><label>Title</label><input id='p_title' type='text'></div><div class='field'><label>Author</label><input id='p_author' type='text'></div><div class='field'><label>Body</label><textarea id='p_body'></textarea></div><div style='text-align:right'><button class='btn' id='savePostBtn'>Publish</button></div>`); qs('#savePostBtn').addEventListener('click', ()=>{ const t=qs('#p_title').value.trim(), a=qs('#p_author').value.trim(), b=qs('#p_body').value.trim(); if(!t){alert('Title required');return} state.posts.unshift({title:t,author:a||'Admin',body:b,date:new Date().toLocaleString()}); save(); closeModal(); renderView('posts') }) }
function editPost(i){ const p=state.posts[i]; showModal(`<h3>Edit Post</h3><div class='field'><label>Title</label><input id='p_title' type='text' value='${escapeHtml(p.title)}'></div><div class='field'><label>Author</label><input id='p_author' type='text' value='${escapeHtml(p.author)}'></div><div class='field'><label>Body</label><textarea id='p_body'>${escapeHtml(p.body)}</textarea></div><div style='text-align:right'><button class='btn' id='updatePostBtn'>Update</button></div>`); qs('#updatePostBtn').addEventListener('click', ()=>{ state.posts[i].title=qs('#p_title').value; state.posts[i].author=qs('#p_author').value; state.posts[i].body=qs('#p_body').value; save(); closeModal(); renderView('posts') }) }
function deletePost(i){ if(confirm('Delete post?')){ state.posts.splice(i,1); save(); renderView('posts') } }

// --- Inbox ---
function renderInbox(container){ container.innerHTML = `<h3>Inbox</h3><div style='margin-top:12px'><button class='btn' onclick='seedMessage()'>Seed message</button></div><table class='table'><thead><tr><th>From</th><th>Subject</th><th>Date</th><th>Actions</th></tr></thead><tbody>${state.inbox.map((m,i)=>`<tr><td>${escapeHtml(m.from)}</td><td>${escapeHtml(m.subject)}</td><td>${escapeHtml(m.date)}</td><td class='actions'><button class='btn ghost' onclick='viewMessage(${i})'>View</button><button class='btn' onclick='deleteMessage(${i})'>Delete</button></td></tr>`).join('')}</tbody></table>` }
function seedMessage(){ state.inbox.unshift({from:'visitor@example.com',subject:'Inquiry about course',body:'Hello, I want info',date:new Date().toLocaleString()}); save(); renderView('inbox') }
function viewMessage(i){ const m=state.inbox[i]; showModal(`<h3>Message</h3><p><strong>From:</strong> ${escapeHtml(m.from)}</p><p><strong>Subject:</strong> ${escapeHtml(m.subject)}</p><div class='field'><label>Message</label><textarea readonly>${escapeHtml(m.body)}</textarea></div><div style='text-align:right'><button class='btn' onclick='closeModal()'>Close</button></div>`)}
function deleteMessage(i){ if(confirm('Delete message?')){ state.inbox.splice(i,1); save(); renderView('inbox') } }

// --- Admin users management ---
function renderAdmins(container){ container.innerHTML = `<h3>Admin Users</h3><div style='margin-top:12px'><button class='btn' onclick='showModalAddAdmin()'>Add Admin</button></div><table class='table'><thead><tr><th>Username</th><th>Actions</th></tr></thead><tbody>${state.admins.map((a,i)=>`<tr><td>${escapeHtml(a.username)}</td><td class='actions'><button class='btn ghost' onclick='editAdmin(${i})'>Edit</button><button class='btn' onclick='deleteAdmin(${i})'>Delete</button></td></tr>`).join('')}</tbody></table>` }
function showModalAddAdmin(){ showModal(`<h3>New Admin</h3><div class='field'><label>Username</label><input id='a_user' type='text'></div><div style='text-align:right'><button class='btn' id='saveAdminBtn'>Save</button></div>`); qs('#saveAdminBtn').addEventListener('click', ()=>{ const u=qs('#a_user').value.trim(); if(!u){alert('Username required');return} state.admins.push({username:u}); save(); closeModal(); renderView('admins') }) }
function editAdmin(i){ const a=state.admins[i]; showModal(`<h3>Edit Admin</h3><div class='field'><label>Username</label><input id='a_user' type='text' value='${escapeHtml(a.username)}'></div><div style='text-align:right'><button class='btn' id='updateAdminBtn'>Update</button></div>`); qs('#updateAdminBtn').addEventListener('click', ()=>{ state.admins[i].username=qs('#a_user').value; save(); closeModal(); renderView('admins') }) }
function deleteAdmin(i){ if(confirm('Delete admin?')){ state.admins.splice(i,1); save(); renderView('admins') } }

// --- Settings ---
function renderSettings(container){ container.innerHTML = `<h3>Settings</h3><div class='field'><label>Reset demo data</label><button class='btn ghost' onclick='resetDemo()'>Reset</button></div><div class='field'><label>Export JSON</label><button class='btn' onclick='exportAll()'>Export</button></div><div class='field'><label>Clear all</label><button class='btn ghost' onclick='clearAll()'>Clear</button></div>` }
function resetDemo(){ if(confirm('Reset to demo data?')){ state = JSON.parse(JSON.stringify(DEFAULT)); save(); renderView(currentView); alert('Reset') } }
function clearAll(){ if(confirm('Clear all saved data?')){ localStorage.removeItem('tabit_full'); state = load(); renderView(currentView); renderSummary(); alert('Cleared') } }

// --- utilities: modal, import/export, file dialog ---
function showModal(html){ qs('#backdrop').style.display='block'; const m=qs('#modal'); m.style.display='block'; m.innerHTML = html + `<div style='text-align:right;margin-top:12px'><button class='btn ghost' onclick='closeModal()'>Close</button></div>` }
function closeModal(){ qs('#backdrop').style.display='none'; qs('#modal').style.display='none'; qs('#modal').innerHTML='' }
function exportAll(){ const data = JSON.stringify(state, null, 2); const blob = new Blob([data],{type:'application/json'}); const url=URL.createObjectURL(blob); const a=document.createElement('a'); a.href=url; a.download='tabit_admin_export.json'; a.click(); URL.revokeObjectURL(url) }
function openFileDialog(cb){ const inp=document.createElement('input'); inp.type='file'; inp.accept='application/json'; inp.onchange = e=>{ const f=e.target.files[0]; const r=new FileReader(); r.onload = ev=>cb(ev.target.result); r.readAsText(f) }; inp.click() }
function handleImport(text){ try{ const parsed = JSON.parse(text); state = parsed; save(); renderView(currentView); alert('Imported') }catch(e){ alert('Invalid JSON') } }

function handleImportFileText(text){ handleImport(text) }

function seedInitial(){ if(state.faculty.length===0 && state.orgs.length===0){ state.faculty.push({name:'Dr. Maria Cruz',dept:'Computer Science',email:'m.cruz@example.com'}); state.orgs.push({name:'Tech Society',contact:'contact@tech.org'}); state.posts.push({title:'Welcome to TabIT',author:'Admin',body:'First post',date:new Date().toLocaleString()}); save() } }

// helper wrappers to call from HTML-embedded handlers
window.showModalAddFaculty = showModalAddFaculty
window.showModalAddOrg = showModalAddOrg
window.editFaculty = editFaculty
window.deleteFaculty = deleteFaculty
window.editOrg = editOrg
window.deleteOrg = deleteOrg
window.showModalAddPost = showModalAddPost
window.editPost = editPost
window.deletePost = deletePost
window.viewMessage = viewMessage
window.deleteMessage = deleteMessage
window.showModalAddAdmin = showModalAddAdmin
window.editAdmin = editAdmin
window.deleteAdmin = deleteAdmin
window.seedMessage = seedMessage
window.bulkSeedFaculty = bulkSeedFaculty

function escapeHtml(s){ if(s==null) return ''; return String(s).replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('\"','&quot;') }

function handleImport(data){ try{ const parsed = JSON.parse(data); state = parsed; save(); renderView(currentView); alert('Imported successfully') }catch(e){ alert('Import failed: invalid JSON') } }

// storage sync
window.addEventListener('storage', ()=>{ state = load(); renderSummary(); })

// startup
seedInitial(); init();

</script>
</body>
</html>