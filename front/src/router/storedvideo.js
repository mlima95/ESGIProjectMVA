export default [
  {
    name: "StoredVideoList",
    path: "/stored_videos/",
    component: () =>
      import(
        /* webpackChunkName: "storedvideo" */ "../components/resources/storedvideo/List"
      ),
  }
];
