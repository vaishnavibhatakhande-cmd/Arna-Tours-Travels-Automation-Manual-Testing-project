import re

from playwright.sync_api import Page, expect


def test_homepage(page: Page):
    page.goto("https://graceful-marigold-86dd01.netlify.app/", wait_until="domcontentloaded")

    expect(page.get_by_text("PREMIUM TAXI & TRAVEL SERVICES")).to_be_visible()
    expect(page.get_by_text("WHAT WE DO")).to_be_visible()
    expect(page.get_by_role("heading", name="Airport Transfers")).to_be_visible()

    page.get_by_role("link", name=re.compile(r"Book transfer", re.IGNORECASE)).click()
    page.get_by_role("heading", name="Outstation Trips").click()
    page.get_by_role("heading", name="Corporate Travel").click()
    page.get_by_role("heading", name="Local Rentals").click()
    expect(page.locator("p.eyebrow").filter(has_text="OUR FLEET")).to_be_visible()

    expect(page.locator("#contact")).to_be_visible()
    page.locator("#contact").click()