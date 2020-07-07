<style>
	.addon-li {
    width: 380px;
}
.addon-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
}
.group-name {
    font-size: 20px;
    margin: 0 0 20px 0;
}
.addon {
    position: relative;
    margin: 0 30px 30px 0;
    padding: 0px 30px 20px 30px;
    border: 1px solid #eaeaea;
    border-radius: 5px;
    background: #fff;
}
.addon__on {
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    width: 100%;
    height: 4px;
    background: #6a4a86;
    position: absolute;
    top: -1px;
    left: 0;
}
.addon__img {
    text-align: center;
    margin: 10px 0;
}
.addon__description {
    height: 100px;
    margin-bottom: 20px;
}
.text-ter {
    color: #888888;
}
.row {
    margin-left: -15px;
    margin-right: -15px;
}
.addon__switch {
    margin-top: 20px;
    text-align: center;
    height: 60px;
}

.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-inner {
    display: block;
    width: 200%;
    margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-label {
    display: block;
    overflow: hidden;
    cursor: pointer;
    border-radius: 20px;
}
.onoffswitch {
    position: relative;
    display: inline-block;
    width: 54px;
    text-align: left;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}
</style>