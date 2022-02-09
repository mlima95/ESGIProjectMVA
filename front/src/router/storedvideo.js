export default [
  {
    name: "StoredVideoList",
    path: "/stored_videos/",
    component: () =>
      import(
        /* webpackChunkName: "storedvideo" */ "../components/resources/storedvideo/List"
      ),
  },
  {
    name: "StoredVideoCreate",
    path: "/stored_videos/create",
    component: () =>
      import(
        /* webpackChunkName: "storedvideo" */ "../components/resources/storedvideo/Create"
      ),
  },
  {
    name: "StoredVideoUpdate",
    path: "/stored_videos/edit/:id",
    component: () =>
      import(
        /* webpackChunkName: "storedvideo" */ "../components/resources/storedvideo/Update"
      ),
  },
  {
    name: "StoredVideoShow",
    path: "/stored_videos/show/:id",
    component: () =>
      import(
        /* webpackChunkName: "storedvideo" */ "../components/resources/storedvideo/Show"
      ),
  },
];
