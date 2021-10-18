<template>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="javascript:void(0);">{{title}}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
      <span>{{ subTitle }}</span>
    </li>
  </ol>
</template>

<script>
export default {
    props: ["title", "subTitle"]
};
</script>

<style>
</style>